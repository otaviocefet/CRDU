<?php
class Inicio
{
  public function controller()
  {
    $inicio = new Template("view/inicio.html");
    $inicio->set("Início", "Seja bem Vindo!");
    $retorno["msg"] = $inicio->saida();
    return $retorno;
  }
}