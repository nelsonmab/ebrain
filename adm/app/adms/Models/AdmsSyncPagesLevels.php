<?php

namespace App\adms\Models;

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Sincronizar o nivel de acesso e as paginas
 *
 * @author Celke
 */
class AdmsSyncPagesLevels
{

    /** @var array|null $dataLevelPage Recebe as informacoes que devem ser salva no BD */
    private array|null $dataLevelPage;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var array|null $resultBdLevels Recebe os registros do banco de dados */
    private array|null $resultBdLevels;

    /** @var array|null $resultBdPages Recebe os registros do banco de dados */
    private array|null $resultBdPages;

    /** @var array|null $resultBdLevelPage Recebe os registros do banco de dados */
    private array|null $resultBdLevelPage;

    /** @var array|null $resultBdLastOrder Recebe os registros do banco de dados */
    private array|null $resultBdLastOrder;

    /** @var array|null $resultBdLevelDefault Recebe os registros do banco de dados */
    private array|null $resultBdLevelDefault;

    /** @var int|string|null $levelId Recebe o id do nivel de acesso */
    private int|string|null $levelId;

    /** @var int|string|null $publish Recebe o tipo de permissao de da pagina */
    private int|string|null $publish;

    /** @var int|string|null $pageId Recebe o id da pagina */
    private int|string|null $pageId;


    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo recuperar os niveis de acesso no BD
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    public function syncPagesLevels(): void
    {

        $listLevels = new \App\adms\Models\helper\AdmsRead();
        $listLevels->fullRead("SELECT id FROM adms_access_levels");

        $this->resultBdLevels = $listLevels->getResult();
        if ($this->resultBdLevels) {
            $this->listPages();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhum nível de acesso encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo recuperar as paginas no BD
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function listPages(): void
    {

        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT id, publish FROM adms_pages");

        $this->resultBdPages = $listPages->getResult();
        if ($this->resultBdPages) {
            $this->readLevels();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhuma página encontrada!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo ler os niveis de acesso
     * @return void
     */
    private function readLevels(): void
    {
        foreach ($this->resultBdLevels as $level) {
            extract($level);
            $this->levelId = $id;
            $this->readPages();
        }
    }

    /**
     * Metodo ler as paginas
     * @return void
     */
    private function readPages(): void
    {
        foreach ($this->resultBdPages as $page) {
            extract($page);
            $this->pageId = $id;
            $this->publish = $publish;
            $this->searchLevelPage();
        }
    }

    /**
     * Metodo recuperar as paginas no BD
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function searchLevelPage(): void
    {

        $listLevelPage = new \App\adms\Models\helper\AdmsRead();
        $listLevelPage->fullRead("SELECT id
                                FROM adms_levels_pages
                                WHERE adms_access_level_id =:adms_access_level_id 
                                AND adms_page_id =:adms_page_id", "adms_access_level_id={$this->levelId}&adms_page_id={$this->pageId}");

        $this->resultBdLevelPage = $listLevelPage->getResult();
        if ($this->resultBdLevelPage) {
            $_SESSION['msg'] = "<p class='alert-success'>Todas as permissões estão sincronizadas!</p>";
            $this->result = true;
        } else {
            $this->addLevelPermission();
        }
    }

    /**
     * Metodo cadastrar na tabela "adms_levels_pages".
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function addLevelPermission(): void
    {
        $this->searchLastOrder();
        $this->dataLevelPage['permission'] = (($this->levelId == 1) OR ($this->publish == 1)) ? 1 : 2;
        $this->searchLevelDefault();
        $this->dataLevelPage['order_level_page'] = $this->resultBdLastOrder[0]['order_level_page'] + 1;
        $this->dataLevelPage['adms_access_level_id'] = $this->levelId;
        $this->dataLevelPage['adms_page_id'] = $this->pageId;
        $this->dataLevelPage['created'] = date("Y-m-d H:i:s");

        $addAccessLevel = new \App\adms\Models\helper\AdmsCreate();
        $addAccessLevel->exeCreate("adms_levels_pages", $this->dataLevelPage);

        if($addAccessLevel->getResult()){
            $_SESSION['msg'] = "<p class='alert-success'>Permissões sincronizadas com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Permissões não sincronizadas com sucesso!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo para verificar se ha pagina esta cadastrada para o nivel de acesso na tabela "adms_levels_pages".
     * Retorna FALSE se houver algum erro.
     * @return void
     */
    private function searchLastOrder(): void
    {
        $viewLastOrder = new \App\adms\Models\helper\AdmsRead;
        $viewLastOrder->fullRead(
            "SELECT order_level_page, adms_access_level_id 
                                FROM adms_levels_pages
                                WHERE adms_access_level_id =:adms_access_level_id
                                ORDER BY order_level_page DESC
                                LIMIT :limit",
            "adms_access_level_id={$this->levelId}&limit=1"
        );

        $this->resultBdLastOrder = $viewLastOrder->getResult();
        if(!$this->resultBdLastOrder){
            $this->resultBdLastOrder[0]['order_level_page'] = 0;
        }
    }

    private function searchLevelDefault(): void
    {
        $viewLevelDefault = new \App\adms\Models\helper\AdmsRead;
        $viewLevelDefault->fullRead(
            "SELECT permission, print_menu, dropdown, adms_items_menu_id 
                                FROM adms_levels_pages
                                WHERE adms_page_id =:adms_page_id
                                AND adms_access_level_id = 7
                                LIMIT :limit",
            "adms_page_id={$this->pageId}&limit=1"
        );

        $this->resultBdLevelDefault = $viewLevelDefault->getResult();
        if($this->resultBdLevelDefault){
            $this->dataLevelPage['permission'] = $this->resultBdLevelDefault[0]['permission'];
            $this->dataLevelPage['print_menu'] = $this->resultBdLevelDefault[0]['print_menu'];
            $this->dataLevelPage['dropdown'] = $this->resultBdLevelDefault[0]['dropdown'];
            $this->dataLevelPage['adms_items_menu_id'] = $this->resultBdLevelDefault[0]['adms_items_menu_id'];
        }
    }
}
