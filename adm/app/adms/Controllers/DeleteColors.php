<?php

namespace App\adms\Controllers;

if(!defined('E8R4IN')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller apagar cor
 * @author Nelson Oliveira de almeida -00727732277<nelsonoliveirank@gmail.com>>
 */
class DeleteColors
{

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;
    
    /**
     * Método apagar cor
     * Se existir o ID na URL instancia a MODELS para excluir o registro no banco de dados
     * Senão criar a mensagem de erro
     * Redireciona para a página listar cor
     *
     * @param integer|string|null|null $id Receber o id do registro que deve ser excluido
     * @return void
     */
    public function index(int|string|null $id = null): void
    {

        if (!empty($id)) {
            $this->id = (int) $id;
            $deleteColor = new \App\adms\Models\AdmsDeleteColors();
            $deleteColor->deleteColor($this->id);            
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar uma cor!</p>";
        }

        $urlRedirect = URLADM . "list-colors/index";
        header("Location: $urlRedirect");

    }
}
