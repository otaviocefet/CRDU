<?php
class Login
{
  public function _construct()
  {
      Transaction::open();
  }
  public function controller() {
    $login = new Template("view/login.html");
    $retorno["msg"] = $login->saida();
    return $retorno;
  }

  public function entrar() {
    if (isset($_POST["sinopse"]) & isset($_POST["elenco"])) {
        try {
            $conexao = Transaction::get();
            $crud = new Crud();
            $sinopse = $conexao->quote($_POST["sinopse"]);
            $elenco = $conexao->quote($_POST["elenco"]);
            $retorno = $crud->select("*", "sinopse={$sinopse} AND elenco={$elenco}";
            if(!$retorno["erro"]) {
                new Session;
                Session::setValue("id", $retorno["msg"][0]["id"])
                Session::setValue("filme", $retorno["msg"][0]["filme"])
                header("Location:restrita.php");
            }
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