<?php
class Pessoa
{
    public function controller()
    {
        $inicio = new Template ("view/Inicio.html");
        $pessoa = Session::getValue("nome");
        $inicio -> set("inicio", " BEM VINDO! FAÇA SUA INSERÇÃO {$pessoa}!")
        $retorno["msg"] = $inicio->saida();
        return $retorno;
    }
}