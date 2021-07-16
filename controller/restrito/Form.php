<?php
class Form
{
  public function _construct()
  {
      Transaction::open();
  }
  public function controller() {
      try {
          $conexao = Transaction::get();
          $crud = new Crud();
          $filme = $crud->select("filme")
          if (!$filme["erro"]) {
              $form = new Template("view/form.html");
              $form ->set("filme", $sinopse["msg"]);
              $form ->set("sinopse", "");
              $form ->set("elenco", "");
              $retorno["msg"] = $reg->saida();
          }
      } catch (\Throwable $th){
        //throw $sth;
      }
      return $retorno;
  }

  public function salvar() {
    if (isset($_POST["nome"]) && isset($_POST["sinopse"]) & isset($_POST["elenco"])) {
        try {
            $conexao = Transaction::get();
            $crud = new Crud();
            $nome = $conexao->quote($_POST["nome"]);
            $filme = $conexao->quote($_POST["sinopse"]);
            $desc = $conexao->quote($_POST["elenco"]);
            if (issets($_POST["id"]) && !empty($_POST["id"])) {
                $id = $conexao->quote($_POST["id"]);
                $retorno = $crud->update("filme, nome={$nome)", "sinopse={$sinopse}", "elenco={$elenco}", "id={$id}");
            } else {
                $retorno = $crud->insert("filme", "nome, sinopse, elenco", "($nome),($sinopse),($elenco)")
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


    public function delete(){
        if(isset($_GET["id"])){
            try{
                $conexao = Transaction::get();
                $id = $conexao->quote($_GET["id"]);
                $crud = new Crud();
                $retorno = $crud->delete("filme", "id={$id}");
            }
        }
    }
    
    return $retorno;

  }
  public function __destruct(){
      Transaction::close();
  }
}


