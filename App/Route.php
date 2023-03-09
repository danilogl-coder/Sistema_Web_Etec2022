<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['index'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);
		$routes['cursos'] = array(
			'route' => '/cursos',
			'controller' => 'indexController',
			'action' => 'cursos'
		);
			$routes['paginaCurso'] = array(
			'route' => '/paginaCurso',
			'controller' => 'indexController',
			'action' => 'paginaCurso'
		);
		$routes['vestibulinho'] = array(
			'route' => '/vestibulinho',
			'controller' => 'indexController',
			'action' => 'vestibulinho'
		);
			$routes['estagio'] = array(
			'route' => '/estagio',
			'controller' => 'indexController',
			'action' => 'estagio'
		);
			$routes['historia'] = array(
			'route' => '/historia',
			'controller' => 'indexController',
			'action' => 'historia'
		);
			$routes['estrutura'] = array(
			'route' => '/estrutura',
			'controller' => 'indexController',
			'action' => 'estrutura'
		);
			$routes['contato'] = array(
			'route' => '/contato',
			'controller' => 'indexController',
			'action' => 'contato'
		);
			$routes['login'] = array(
			'route' => '/login',
			'controller' => 'indexController',
			'action' => 'login'
		);
			$routes['cadastrar'] = array(
			'route' => '/cadastrar',
			'controller' => 'indexController',
			'action' => 'cadastrar'
		);
			$routes['usuarioCadastrar'] = array(
			'route' => '/usuarioCadastrar',
			'controller' => 'indexController',
			'action' => 'usuarioCadastrar'
		);
			$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

			$routes['areaAdm'] = array(
			'route' => '/areaAdm',
			'controller' => 'AppController',
			'action' => 'areaAdm'
		);
			$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);
			$routes['usuarioMenu'] = array(
			'route' => '/usuarioMenu',
			'controller' => 'AppController',
			'action' => 'usuarioMenu'
		);
			$routes['formUsuario'] = array(
			'route' => '/formUsuario',
			'controller' => 'AppController',
			'action' => 'formUsuario'
		);
			$routes['alterarUsuario'] = array(
			'route' => '/alterarUsuario',
			'controller' => 'AppController',
			'action' => 'alterarUsuario'
		);
			$routes['excluirUsuario'] = array(
			'route' => '/excluirUsuario',
			'controller' => 'AppController',
			'action' => 'excluirUsuario'
		);
			$routes['alterarCargoUsuario'] = array(
			'route' => '/alterarCargoUsuario',
			'controller' => 'AppController',
			'action' => 'alterarCargoUsuario'
		);
			$routes['cursoMenu'] = array(
			'route' => '/cursoMenu',
			'controller' => 'AppController',
			'action' => 'cursoMenu'
		);
			$routes['formCurso'] = array(
			'route' => '/formCurso',
			'controller' => 'AppController',
			'action' => 'formCurso'
		);
			$routes['cadastrarCurso'] = array(
			'route' => '/cadastrarCurso',
			'controller' => 'AppController',
			'action' => 'cadastrarCurso'
		);
			$routes['recuperarCurso'] = array(
			'route' => '/recuperarCurso',
			'controller' => 'AppController',
			'action' => 'recuperarCurso'
		);
			$routes['alterarCurso'] = array(
			'route' => '/alterarCurso',
			'controller' => 'AppController',
			'action' => 'alterarCurso'
		);
			$routes['excluirCurso'] = array(
			'route' => '/excluirCurso',
			'controller' => 'AppController',
			'action' => 'excluirCurso'
		);
			$routes['inserirPublicacao'] = array(
			'route' => '/inserirPublicacao',
			'controller' => 'AppController',
			'action' => 'inserirPublicacao'
		);
			$routes['alterarPublicacao'] = array(
			'route' => '/alterarPublicacao',
			'controller' => 'AppController',
			'action' => 'alterarPublicacao'
		);
			$routes['excluirPublicacao'] = array(
			'route' => '/excluirPublicacao',
			'controller' => 'AppController',
			'action' => 'excluirPublicacao'
		);
			$routes['cursoArquivos'] = array(
			'route' => '/cursoArquivos',
			'controller' => 'indexController',
			'action' => 'cursoArquivos'
		);
			$routes['inserirArquivo'] = array(
			'route' => '/inserirArquivo',
			'controller' => 'AppController',
			'action' => 'inserirArquivo'
		);
			$routes['alterarArquivo'] = array(
			'route' => '/alterarArquivo',
			'controller' => 'AppController',
			'action' => 'alterarArquivo'
		);
			$routes['excluirArquivo'] = array(
			'route' => '/excluirArquivo',
			'controller' => 'AppController',
			'action' => 'excluirArquivo'
		);
			$routes['cursoGaleria'] = array(
			'route' => '/cursoGaleria',
			'controller' => 'indexController',
			'action' => 'cursoGaleria'
		);
			$routes['inserirCursoGaleria'] = array(
			'route' => '/inserirCursoGaleria',
			'controller' => 'AppController',
			'action' => 'inserirCursoGaleria'
		);
			$routes['excluirCursoGaleria'] = array(
			'route' => '/excluirCursoGaleria',
			'controller' => 'AppController',
			'action' => 'excluirCursoGaleria'
		);
			$routes['alterarEstagio'] = array(
			'route' => '/alterarEstagio',
			'controller' => 'AppController',
			'action' => 'alterarEstagio'
		);
			$routes['alterarEmpresa'] = array(
			'route' => '/alterarEmpresa',
			'controller' => 'AppController',
			'action' => 'alterarEmpresa'
		);
			$routes['inserirArquivoEstagio'] = array(
			'route' => '/inserirArquivoEstagio',
			'controller' => 'AppController',
			'action' => 'inserirArquivoEstagio'
		);
			$routes['excluirArquivoEstagio'] = array(
			'route' => '/excluirArquivoEstagio',
			'controller' => 'AppController',
			'action' => 'excluirArquivoEstagio'
		);
			$routes['alterarEstrutura'] = array(
			'route' => '/alterarEstrutura',
			'controller' => 'AppController',
			'action' => 'alterarEstrutura'
		);
			$routes['alterarVestibulinho'] = array(
			'route' => '/alterarVestibulinho',
			'controller' => 'AppController',
			'action' => 'alterarVestibulinho'
		);




		



		$this->setRoutes($routes);
	}

}

?>