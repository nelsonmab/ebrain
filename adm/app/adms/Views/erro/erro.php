<?php

if(!defined('E8R4IN')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

echo "VIEW - Página erro!<br>";
var_dump($this->data);
echo $this->data;