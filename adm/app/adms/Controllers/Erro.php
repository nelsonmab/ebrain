<?php

namespace App\adms\Controllers;

if(!defined('E8R4IN')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller página erro
 * @author Nelson Oliveira de almeida -00727732277<nelsonoliveirank@gmail.com>>
 */
class Erro
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index():void
    {

        $this->data = "<p style='color: #f00;'>Página não encontrada!</p>";

        $loadView = new \Core\ConfigView("adms/Views/erro/erro", $this->data);
        $loadView->loadViewLogin();
    }
}