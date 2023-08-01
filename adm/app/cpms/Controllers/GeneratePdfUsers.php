<?php

namespace App\cpms\Controllers;

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller gerar PDF
 * @author Nelson Oliveira de Almeida <nelsonoliveirank@gmail.com e.com.br>
 */
class GeneratePdfUsers
{

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;

            $generatePdfUsers = new \App\cpms\Models\CpmsGeneratePdfUsers();
            $generatePdfUsers->viewUser($this->id);
            if (!$generatePdfUsers->getResult()) {
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não encontrado!</p>";
            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
    }
}
