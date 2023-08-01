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
class GeneratePdfListUsers
{

    public function index(): void
    {
        $generatePdfListUsers = new \App\cpms\Models\CpmsGeneratePdfListUsers();
        $generatePdfListUsers->listUsers();
        if (!$generatePdfListUsers->getResult()) {
            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
    }
}
