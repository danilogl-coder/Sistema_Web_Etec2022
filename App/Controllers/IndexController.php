<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		session_start();
	
		$pub = Container::getModel("Publicacao");	
		$pubs = $pub->recuperarAllPagina();


		$this->view->getAllPubs = $pubs;
		$this->render('index','layout');

	}
	public function cursos() {
		session_start();
		$curso = Container::getModel('Curso');
		$this->view->getAllCursos = $curso->recuperar();
		$this->render('cursos');
	}
	public function paginaCurso()
	{
		session_start();
		
		if(isset($_POST['id']))
		{
		$_SESSION['curso_id'] = $_POST['id'];
		}
		if(!isset($_SESSION['curso_id']))
		{
			header('location:cursos');
		}
		$curso = Container::getModel('Curso');
		$curso->__set('id',$_SESSION['curso_id']);
		$this->view->getCurso = $curso->recuperarCurso();

		$pub = Container::getModel('Publicacao');
		$pub->__set('curso_id',$_SESSION['curso_id']);
		$this->view->getPubs = $pub->recuperarPagina();

		if(isset($_GET['metodo']) && $_GET['metodo'] == 'Alterar')
		{
			$pub->__set('id',$_GET['id']);
			$pubs = $pub->recuperarPaginaId();
			$this->view->getPubById = $pubs;

			$_SESSION['imagem'] = $pubs['imagem'];
		}


		$this->render('pagina_do_curso');
	}

	public function cursoArquivos()
	{
		session_start();
		$curso = Container::getModel('Curso');
		$curso->__set('id',$_SESSION['curso_id']);
		$this->view->getCurso = $curso->recuperarCurso();

		$file = Container::getModel('Arquivo');
		$file->__set('curso_id',$_SESSION['curso_id']);
		$this->view->getFile = $file->recuperar();

		if(isset($_GET['metodo']) && $_GET['metodo'] == 'Alterar')
		{
		$file->__set('id',$_GET['id']);
		$this->view->getFileId = $file->recuperarArquivo();
		$_SESSION['arquivo'] = $this->view->getFileId['arquivo'];
		}
		
		$this->render('pagina_do_curso_arquivos');
	}
	public function cursoGaleria()
	{
		session_start();

		$curso = Container::getModel('Curso');
		$curso->__set('id',$_SESSION['curso_id']);
		$this->view->getCurso = $curso->recuperarCurso();

		$galeria = Container::getModel('CursoGaleria');
		$galeria->__set('curso_id',$_SESSION['curso_id']);
		$this->view->getGaleria = $galeria->recuperar();
		$this->render('pagina_do_curso_galeria');
	}
	public function vestibulinho() {
		session_start();
		$vest = Container::getModel('Vestibulinho');
		$this->view->getVest = $vest->recuperar();
		$this->render('vestibulinho');
	}
	public function estagio() {
		session_start();
		$estagio = Container::getModel('Estagio');
		$this->view->getEstagio = $estagio->recuperar();

		$eArquivo = Container::getModel('EstagioArquivo');
		$this->view->geteEstagio = $eArquivo->recuperar();
		$this->render('estagio');
	}
	public function historia() {
		session_start();
		$this->render('historia');
	}
	public function estrutura() {
		session_start();
		$est = Container::getModel('Estrutura');
		$this->view->getEst = $est->recuperar();
		$this->render('estrutura');
	}
	public function contato() {
		session_start();
		$this->render('contato');
	}
	public function login() {
		$this->view->successCadastro = false;
		$this->render('login');
	}
	public function cadastrar() {

		$this->view->usuario = array(
			'nome' => "",
			'email' => "",
			'senha' => "",
		);
		$this->view->erroCadastro = false;
		$this->render('cadastrar');
	}

	public function usuarioCadastrar()
	{
		$usuario = Container::getModel('Usuario');
		$usuario->__set('nome',$_POST['nome']);
		$usuario->__set('email',$_POST['email']);
		$usuario->__set('senha',$_POST['senha']);
		
		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0)
		{
		$usuario->salvar();
		$this->view->successCadastro = true;
		$this->render('login');
		}
		else
		{
		$this->view->erroCadastro = true;
		$this->view->usuario = array(
			'nome' => $_POST['nome'],
			'email' => $_POST['email'],
			'senha' => $_POST['senha'],
		);
		$this->render('cadastrar');
		}
	}

}


?>