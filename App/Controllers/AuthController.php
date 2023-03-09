<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action 
{
	public function autenticar()
	{
		$usuario = Container::getModel('Usuario');

		$usuario->__set('email',$_POST['email']);
		$usuario->__set('senha',$_POST['senha']);

		$retorno = $usuario->autenticar();

		if($usuario->__get('id') != '' && $usuario->__get('nome') != '')
		{
			echo "Autenticado";
			session_start();
			$_SESSION['id'] = $usuario->__get('id');
			$_SESSION['nome'] = $usuario->__get('nome');
			$_SESSION['tipo'] = $usuario->__get('tipo');

			header('location: /areaAdm');
		}
		else
		{
			header('location:login?erro=erro');
		}
	}

	public function sair()
	{
		session_start();
		session_destroy();
		header('location:login');
	}
}
?>