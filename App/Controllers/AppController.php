<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action 
{
	public function areaAdm()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();
		$this->render('areaAdm');
		
		
	}

	public function autenticacaoPadrao()
	{
		session_start();
		if(!isset($_SESSION['id']) || isset($_SESSION['id']) == '' || !isset($_SESSION['nome']) || isset($_SESSION['nome']) == '' )
		{
			header("location:/login?erro=erro");
		}
	}

	public function autenticacaoUser()
	{
		
		if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Usuário')
		{
		header("location:/");
		}
	}

	public function usuarioMenu()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();
		$usuario = Container::getModel('Usuario');

		$this->view->usuarios = $usuario->recuperar();
		$this->render('usuarioMenu');

	}
	
	public function formUsuario()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id',$_GET['id']);
		$usuarios = $usuario->recuperarUsuario();
		$this->view->recuperarUsuario = $usuarios;
		$this->render('form.usuario');
	}

	public function alterarUsuario()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id',$_POST['id']);
		$usuario->__set('nome',$_POST['nome']);
		$usuario->__set('email',$_POST['email']);
		$usuario->__set('senha',$_POST['senha']);

		$usuario->alterar();

		header('location:/usuarioMenu');
	}

	public function excluirUsuario()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id',$_GET['id']);
		$usuario->excluir();

		header('location:/usuarioMenu');
	}

	public function alterarCargoUsuario()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();
		$usuario = Container::getModel('Usuario');

		$usuario->__set('id',$_GET['id']);
		$usuario->__set('tipo',$_GET['tipo']);

		$usuario->alterarCargo();
		header('location:/usuarioMenu');
	}

	public function cursoMenu()
	{	
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$curso = Container::getModel('Curso');
		$cursos = $curso->recuperar();
		$this->view->getAllCursos = $cursos;
		$this->render('cursoMenu');
	}

	public function formCurso()
	{	
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();
		$this->render('form.curso');
	}

	public function cadastrarCurso()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$curso = Container::getModel('Curso');
		$curso->__set('titulo',$_POST['titulo']);
		$curso->__set('logotipo',$_FILES['logotipo']['name']);
		$curso->__set('capa',$_FILES['capa']['name']);
		$curso->__set('descricao',$_POST['descricao']);
		
		$curso->inserir();

		$img1 = move_uploaded_file($_FILES['logotipo']['tmp_name'],'arquivos/'.$_FILES['logotipo']['name']);
		$img2 = move_uploaded_file($_FILES['capa']['tmp_name'],'arquivos/'.$_FILES['capa']['name']);

		header('location:formCurso');

	

	}

	public function recuperarCurso()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$curso = Container::getModel('Curso');
		$curso->__set('id',$_GET['id']);
		$cursos = $curso->recuperarCurso();
		$this->view->getCurso = $cursos;
	

		$usuario = Container::getModel('Usuario');
		$usuarios = $usuario->recuperarCoord();
		$this->view->getAllUsuarios = $usuarios;

		$_SESSION['logotipo'] = $cursos['logotipo'];
		$_SESSION['capa'] = $cursos['capa'];

		$this->render('form.curso');

	

	}

	public function alterarCurso()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$cursos = Container::getModel('Curso');

		$cursos->__set('id',$_POST['id']);
		
		if($_POST['usuario_id'] != 0)
		{
		$cursos->__set('usuario_id',$_POST['usuario_id']);
		}
		else 
		{
		$cursos->__set('usuario_id',null);		
		}

		$cursos->__set('titulo',$_POST['titulo']);
		if($_FILES['logotipo']['name'] != '')
		{
			$cursos->__set('logotipo',$_FILES['logotipo']['name']);
		}
		else
		{
			$cursos->__set('logotipo',$_SESSION['logotipo']);
		}

		if($_FILES['capa']['name'] != '')
		{
			$cursos->__set('capa',$_FILES['capa']['name']);
		}
		else
		{
		$cursos->__set('capa',$_SESSION['capa']);
		}
		$cursos->__set('descricao',$_POST['descricao']);

		$cursos->alterar();

		$img1 = move_uploaded_file($_FILES['logotipo']['tmp_name'],'arquivos/'.$_FILES['logotipo']['name']);
		$img2 = move_uploaded_file($_FILES['capa']['tmp_name'],'arquivos/'.$_FILES['capa']['name']);

		header('location:cursoMenu');
		
	}

	public function excluirCurso()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();


		$curso = Container::getModel('Curso');
		$curso->__set('id',$_GET['id']);
		$curso->__set('curso_id',$_GET['id']);

		$cursos = $curso->recuperarCurso();
		unlink('arquivos/'.$cursos['logotipo']);
		unlink('arquivos/'.$cursos['capa']);

		$curso->excluir();
		

		header('location:cursoMenu');
	
	}

	public function inserirPublicacao()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$pub = Container::getModel('Publicacao');
		$pub->__set('usuario_id',$_POST['usuario_id']);
		$pub->__set('curso_id',$_POST['curso_id']);
		$pub->__set('titulo',$_POST['titulo']);
		$pub->__set('descricao',$_POST['descricao']);
		$pub->__set('imagem',$_FILES['imagem']['name']);

		$pub->inserir();

		$img1 = move_uploaded_file($_FILES['imagem']['tmp_name'],'arquivos/'.$_FILES['imagem']['name']);
		

		header('location:paginaCurso?link=cursos&offset=0&qtdPg=5');
	}

	public function alterarPublicacao()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$pub = Container::getModel('Publicacao');
		$pub->__set('id',$_POST['id']);
		$pub->__set('titulo',$_POST['titulo']);
		$pub->__set('descricao',$_POST['descricao']);

		if($_FILES['imagem']['name'] != '')
		{
		$pub->__set('imagem',$_FILES['imagem']['name']);
		}
		else
		{
		$pub->__set('imagem',$_SESSION['imagem']);
		}
		$pub->alterar();

		$img1 = move_uploaded_file($_FILES['imagem']['tmp_name'],'arquivos/'.$_FILES['imagem']['name']);

		header('location:paginaCurso?offset=0&qtdPg=5');
	}

	public function excluirPublicacao()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$pub = Container::getModel("Publicacao");
		$pub->__set('id',$_GET['id']);
		
		$pubs = $pub->recuperarPaginaId();
		unlink('arquivos/'.$pubs['imagem']);
		

		$pub->excluir();
		header('location:paginaCurso?offset=0&qtdPg=5');
	}

	public function inserirArquivo()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$file = Container::getModel('Arquivo');
		$file->__set('usuario_id',$_POST['usuario_id']);
		$file->__set('curso_id',$_POST['curso_id']);
		$file->__set('descricao',$_POST['descricao']);
		$file->__set('arquivo',$_FILES['arquivo']['name']);
		$file->inserir();

		$file1 = move_uploaded_file($_FILES['arquivo']['tmp_name'],'arquivos/'.$_FILES['arquivo']['name']);
		

		header('location:cursoArquivos?offset=0&qtdPg=6');
		
	}

	public function alterarArquivo()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$file = Container::getModel('Arquivo');
		$file->__set('id',$_POST['id']);
		$file->__set('descricao',$_POST['descricao']);
		
		if($_FILES['arquivo']['name'] != '')
		{
		$file->__set('arquivo',$_FILES['arquivo']['name']);	
		}
		else
		{
		$file->__set('arquivo',$_SESSION['arquivo']);
		}
		$file->alterar();

		$file1 = move_uploaded_file($_FILES['arquivo']['tmp_name'],'arquivos/'.$_FILES['arquivo']['name']);
		

		header('location:cursoArquivos?offset=0&qtdPg=6');
	}

	public function excluirArquivo()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$file = Container::getModel('Arquivo');
		$file->__set('id',$_GET['id']);
		
		$files = $file->recuperarArquivo();
		unlink('arquivos/'.$files['arquivo']);

		$file->excluir();
		header('location:cursoArquivos?offset=0&qtdPg=6');
	}

	public function inserirCursoGaleria()
	{
		
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();
		$galeria = Container::getModel('CursoGaleria');
		$galeria->__set('curso_id',$_POST['curso_id']);
		$galeria->__set('usuario_id',$_POST['usuario_id']);
		$galeria->__set('legenda',$_POST['legenda']);
		$galeria->__set('imagem',$_FILES['imagem']['name']);
		
		$galeria->inserir();
		$file1 = move_uploaded_file($_FILES['imagem']['tmp_name'],'arquivos/'.$_FILES['imagem']['name']);
		header('location:cursoGaleria?offset=0&qtdPg=6');
	}

	public function excluirCursoGaleria()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();
		$galeria = Container::getModel('CursoGaleria');
		$galeria->__set('id',$_GET['id']);
		$galeria->excluir();

		header('location:cursoGaleria?offset=0&qtdPg=6');
	}

	public function alterarEstagio()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$estagio = Container::getModel('Estagio');
		$estagio->__set('estagio',$_POST['estagio']);
		$estagio->alterarEstagio();

		header('location:estagio?link=estagio');

	}

	public function alterarEmpresa()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$estagio = Container::getModel('Estagio');
		$estagio->__set('empresa',$_POST['empresa']);
		$estagio->alterarEmpresa();

		header('location:estagio?link=estagio');
	}
	public function inserirArquivoEstagio()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();


		$eArquivo = Container::getModel('EstagioArquivo');
		$eArquivo->__set('estagio_id',$_POST['estagio_id']);
		$eArquivo->__set('arquivo',$_FILES['arquivo']['name']);
		$eArquivo->__set('descricao',$_POST['descricao']);
		$eArquivo->inserir();
		$file1 = move_uploaded_file($_FILES['arquivo']['tmp_name'],'arquivos/'.$_FILES['arquivo']['name']);

		header('location:estagio?link=estagio');
	}

	public function excluirArquivoEstagio()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		$eArquivo = Container::getModel('EstagioArquivo');
		$eArquivo->__set('id',$_GET['id']);

		$eArquivos = $eArquivo->recuperarArquivo();
		unlink('arquivos/'.$eArquivos['arquivo']);

		$eArquivo->excluir();

		header('location:estagio?link=estagio');
	}

	public function alterarEstrutura()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		echo "<pre>";
		print_r($_POST);
		echo "<pre>";

		$est = Container::getModel('Estrutura');
		$est->__set('descricao',$_POST['descricao']);
		$est->alterarEstrutura();
		header('location:estrutura');
	}

	public function alterarVestibulinho()
	{
		$this->autenticacaoPadrao();
		$this->autenticacaoUser();

		echo "<pre>";
		print_r($_FILES);
		echo "<pre>";

		$vest = Container::getModel('Vestibulinho');
		if($_FILES['imagem']['name'] == '')
		{
		$vest->__set('imagem',$_SESSION['imagem']);
		}
		else
		{
		$vest->__set('imagem',$_FILES['imagem']['name']);
		}

		$file1 = move_uploaded_file($_FILES['imagem']['tmp_name'],'arquivos/'.$_FILES['imagem']['name']);
		$vest->alterar();
		header('location:vestibulinho?link=vestibulinho');

	}


}

?>