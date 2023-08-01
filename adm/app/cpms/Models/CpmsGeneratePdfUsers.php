<?php

namespace App\cpms\Models;

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Visualizar o usuário no banco de dados
 *
 * @author Nelson Oliveira de Almeida (007.277.322.77) nelsonoliveirank@gmail.com>
 */
class CpmsGeneratePdfUsers
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

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
     * Metodo para visualizar os detalhes do usuário
     * Recebe o ID do usuário que será usado como parametro na pesquisa
     * Retorna FALSE se houver algum erro
     * @param integer $id
     * @return void
     */
    public function viewUser(int $id): void
    {
        $this->id = $id;

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usr.id, usr.name AS name_usr, usr.nickname, usr.email, 
                            sit.name AS name_sit,
                            lev.name AS name_lev
                            FROM adms_users AS usr
                            INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                            INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id
                            WHERE usr.id=:id AND lev.order_levels >:order_levels
                            LIMIT :limit", "id={$this->id}&order_levels=" . $_SESSION['order_levels'] . "&limit=1");

        $this->resultBd = $viewUser->getResult();
        if ($this->resultBd) {
            //$this->result = true;
            $this->generatePdf();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não encontrado!</p>";
            $this->result = false;
        }
    }

    private function generatePdf()
    {
        $data_pdf = "<h1 style='color: #f00;'>Dados do Usuário</h1>";
        $data_pdf .= "ID do usuário: " . $this->resultBd[0]['id'] . "<br>";
        $data_pdf .= "Nome do usuário: " . $this->resultBd[0]['name_usr'] . "<br>";
        $data_pdf .= "Apelido do usuário: " . $this->resultBd[0]['nickname'] . "<br>";
        $data_pdf .= "E-mail do usuário: " . $this->resultBd[0]['email'] . "<br>";
        $data_pdf .= "Situação do usuário: " . $this->resultBd[0]['name_sit'] . "<br>";
        $data_pdf .= "Nível de acesso do usuário: " . $this->resultBd[0]['name_lev'] . "<br>";

        $generatePdf= new \App\cpms\Models\helper\CpmsGeneratePdf();
        $generatePdf->generatePdf($data_pdf);

        $this->result = true;
    }
}
