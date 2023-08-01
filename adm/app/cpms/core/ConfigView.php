<?php

namespace App\cpms\core;

if(!defined('E8R4IN')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Carregar as páginas da View
 * 
 * @author Nelson Oliveira de Almeida <nelsonoliveirank@gmail.com e.com.br>
 */
class ConfigView
{
    
    /**
     * Receber o endereço da VIEW e os dados.
     * @param string $nameView Endereço da VIEW que deve ser carregada
     * @param array|string|null $data Dados que a VIEW deve receber.
     */
    public function __construct(private string $nameView, private array|string|null $data)
    {
    }

    /**
     * Carregar a VIEW.
     * Verificar se o arquivo existe, e carregar caso exista, não existindo apresenta a mensagem de erro
     * 
     * @return void
     */
    public function loadViewCpms():void
    {
        if(file_exists('app/' .$this->nameView . '.php')){
            include 'app/cpms/Views/include/head.php';
            include 'app/adms/Views/include/navbar.php';
            include 'app/adms/Views/include/menu.php';
            include 'app/' .$this->nameView . '.php';
            include 'app/adms/Views/include/footer.php';
        }else{
            die("Erro - 002: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }
}
