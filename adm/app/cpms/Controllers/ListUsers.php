<?php

namespace App\cpms\Controllers;

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller listar usuários no cpms
 * @author Nelson Oliveira de Almeida <nelsonoliveirank@gmail.com e.com.br>
 */
class ListUsers
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var string|int|null $page Recebe o número página */
    private string|int|null $page;

    /** @var string|null $searchName Recebe o nome do usuario */
    private string|null $searchName;

    /** @var string|null $searchEmail Recebe o email do usuario */
    private string|null $searchEmail;

    /**
     * Método listar usuários.
     * 
     * Instancia a MODELS responsável em buscar os registros no banco de dados.
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senão enviar o array de dados vazio.
     *
     * @return void
     */
    public function index(string|int|null $page = null)
    {
        $this->page = (int) $page ? $page : 1;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->searchName = filter_input(INPUT_GET, 'search_name', FILTER_DEFAULT);
        $this->searchEmail = filter_input(INPUT_GET, 'search_email', FILTER_DEFAULT);

        $listUsers = new \App\cpms\Models\CpmsListUsers();
        if (!empty($this->dataForm['SendSearchUser'])) {
            $this->page = 1;
            $listUsers->listSearchUsers($this->page, $this->dataForm['search_name'], $this->dataForm['search_email']);
            $this->data['form'] = $this->dataForm;
        } elseif ((!empty($this->searchName)) or (!empty($this->searchEmail))) {
            $listUsers->listSearchUsers($this->page, $this->searchName, $this->searchEmail);
            $this->data['form']['search_name'] = $this->searchName;
            $this->data['form']['search_email'] = $this->searchEmail;
        } else {            
            $listUsers->listUsers($this->page);            
        }

        if ($listUsers->getResult()) {
            $this->data['listUsers'] = $listUsers->getResultBd();
            $this->data['pagination'] = $listUsers->getResultPg();
        } else {
            $this->data['listUsers'] = [];
            $this->data['pagination'] = "";
        }

        $button = [
            'add_users' => ['menu_controller' => 'add-users', 'menu_metodo' => 'index'],
            'view_users' => ['menu_controller' => 'view-users', 'menu_metodo' => 'index'],
            'edit_users' => ['menu_controller' => 'edit-users', 'menu_metodo' => 'index'],
            'delete_users' => ['menu_controller' => 'delete-users', 'menu_metodo' => 'index'],            
            'generate_pdf_list_users' => ['menu_controller' => 'generate-pdf-list-users', 'menu_metodo' => 'index']
        ];
        $listBotton = new \App\adms\Models\helper\AdmsButton();
        $this->data['button'] = $listBotton->buttonPermission($button);

        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        $this->data['sidebarActive'] = "list-users";

        $loadView = new \App\cpms\core\ConfigView("cpms/Views/users/listUsers", $this->data);
        $loadView->loadViewCpms();
    }
}
