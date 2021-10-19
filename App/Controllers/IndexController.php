<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : "";
		$this->render('index');
	}

	public function inscreverse() {
		$this->view->erroCadastro = false;
		$this->render('inscreverse');
	}

	public function registrar(){
		//receber os dados do form
		$usuario = Container::getModel('usuario'); // (new Usuario + conexao com banco)
		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));
		
		if ($usuario->validarCadastro() && count($usuario->recuperarUsuarioPorEmail()) == 0){ //Sucesso
			$usuario->salvar();
			$this->render('cadastro');
		} else { //Erro
			$this->view->erroCadastro = true;
			$this->render('inscreverse');
		}
	}
}
?>