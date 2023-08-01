<?php

namespace Core;

if(!defined('E8R4IN')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Configurações básicas do site.
 *
 * @author Nelson Oliveira de almeida -00727732277<nelsonoliveirank@gmail.com>>
 */

abstract class Config
{
    /**
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * 
     * @return void
     */
    protected function configAdm(): void
    {
        define('URL', 'https://ebrainpcpa.000webhostapp.com/adm/');
        define('URLADM', 'https://ebrainpcpa.000webhostapp.com/adm/');

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Login');

        define('HOST', 'localhost');
        define('USER', 'id20678465_root');
        define('PASS', 'policia@2022Maraba');
        define('DBNAME', 'id20678465_ebrain');
        define('PORT', 3306);

        define('EMAILADM', 'ebrainpcpa@gmail.com');
    }
}
