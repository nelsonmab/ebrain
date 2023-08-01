<?php

namespace App\adms\Controllers;

if(!defined('E8R4IN')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da página visualizar situação usuario
 * @author Nelson Oliveira de almeida -00727732277<nelsonoliveirank@gmail.com>>
 */
class ViewSitsUsers
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo visualizar situação usuario
     * Recebe como parametro o ID que será usado para pesquisar as informações no banco de dados e instancia a MODELS AdmsViewSitsUsers
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senão é redirecionado para o listar situação de usuario.
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;

            $viewSitUser = new \App\adms\Models\AdmsViewSitsUsers();
            $viewSitUser->viewSitUser($this->id);
            if ($viewSitUser->getResult()) {
                $this->data['viewSitUser'] = $viewSitUser->getResultBd();
                $this->viewSitUser();
            } else {
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Situação não encontrada!</p>";
            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewSitUser(): void
    {
        $button = ['list_sits_users' => ['menu_controller' => 'list-sits-users', 'menu_metodo' => 'index'],
        'edit_sits_users' => ['menu_controller' => 'edit-sits-users', 'menu_metodo' => 'index'],
        'delete_sits_users' => ['menu_controller' => 'delete-sits-users', 'menu_metodo' => 'index']];
        $listBotton = new \App\adms\Models\helper\AdmsButton();
        $this->data['button'] = $listBotton->buttonPermission($button);

        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu(); 
        
        $this->data['sidebarActive'] = "list-sits-users";
        $loadView = new \Core\ConfigView("adms/Views/sitsUser/viewSitUser", $this->data);
        $loadView->loadView();
    }
}
