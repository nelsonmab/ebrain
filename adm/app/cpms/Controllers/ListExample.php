<?php

namespace App\cpms\Controllers;

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller exemplo pacote complementar
 * @author Nelson Oliveira de Almeida <nelsonoliveirank@gmail.com e.com.br>
 */
class ListExample
{

    public function index(): void
    {
        $exemploList = new \App\cpms\Models\CpmsListExample();
        $exemploList->listExample();

        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        $this->data['sidebarActive'] = "list-example";

        $loadView = new \Core\ConfigView("cpms/Views/example/listExample", $this->data);
        $loadView->loadView();
    }
}
