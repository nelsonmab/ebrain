<?php

namespace App\adms\Controllers;

if(!defined('E8R4IN')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller apagar usuário
 * @author Nelson Oliveira de almeida -00727732277<nelsonoliveirank@gmail.com>>
 */
class DeleteUsers
{

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;
    
    /**
     * Método apagar usuário
     * Se existir o ID na URL instancia a MODELS para excluir o registro no banco de dados
     * Senão criar a mensagem de erro
     * Redireciona para a página listar usuários
     *
     * @param integer|string|null|null $id
     * @return void
     */
    public function index(int|string|null $id = null): void
    {

        if (!empty($id)) {
            $this->id = (int) $id;
            $deleteUser = new \App\adms\Models\AdmsDeleteUsers();
            $deleteUser->deleteUser($this->id);            
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar um usuário!</p>";
        }

        $urlRedirect = URLADM . "list-users/index";
        header("Location: $urlRedirect");

    }
}