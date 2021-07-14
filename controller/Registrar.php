<?php
class Registrar
{
  public function _construct()
  {
      Transaction::open();
  }
  public function controller() {
    $reg = new Template("view/registro.html");
    $retorno["msg"] = $reg->saida();
    return $retorno;
  }

  public function _construct()
  {
      Transaction::open();
  }
  public function salvar() {
    if (isset($_POST["filme"]) && isset($_POST["sinopse"]) & isset($_POST["elenco"])) {
        try {
            $conexao = Transaction::get();
            $crud = new Crud();
            $filme = $conexao->quote($_POST["filme"]);
            $sinopse = $conexao->quote($_POST["sinopse"]);
            $elenco = $conexao->quote($_POST["elenco"]);
            $retorno = $crud->insert("filme", "sinopse", "elenco", "{$filme}", "{$sinopse}", "{$elenco}");
        } catch (\Exception $e) {
            $retorno["msg"] = "Ocorreu um erro!".$e->getMessage();
            $retorno["erro"] = true;
            Transaction::rollback();
        }
    } else {
        $retorno["msg"] = "Preencha todos os campos!";
        $retorno["erro"] = True;
    }
    $status = new Template("view/msg.html");
    $status ->set("cor", ($retorno["erro"]) ? "danger" : "success");
    $status ->set("msg", ($retorno["msg"]);
    $retorno["msg"] = $status->saida();
    return $retorno;

  }
  public function __destruct(){
      Transaction::close();
  }
}