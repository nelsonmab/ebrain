<?php

namespace App\adms\Controllers;

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller SyncPagesLevels
 * @author Nelson Oliveira de almeida -00727732277<nelsonoliveirank@gmail.com>>
 */
class SyncPagesLevels
{

    /** 
     * Metodo SyncPagesLevels
     * Instanciar a classe responsavel em sincronizar o nivel de acesso e as paginas
     * 
     * @return void
     */
    public function index(): void
    {

        $syncPagesLevels = new \App\adms\Models\AdmsSyncPagesLevels();
        $syncPagesLevels->syncPagesLevels();

        $urlRedirect = URLADM . "list-access-levels/index";
        header("Location: $urlRedirect");
    }
}
