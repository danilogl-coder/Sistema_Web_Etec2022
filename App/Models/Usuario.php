<?php 
namespace App\Models;
use MF\Model\Model;

class Usuario extends Model 
{
	private $id;
	private $nome;
	private $email;
	private $senha;
	private $tipo;

	public function __get($atributo)
	{
		return $this->$atributo;
	}

	public function __set($atributo,$valor)
	{
		$this->$atributo = $valor;
	}

	//Salvar
	public function salvar()
	{
		$query = 'insert into tb_usuarios(nome,email,senha)values(:nome,:email,:senha)';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome',$this->__get('nome'));
		$stmt->bindValue(':email',$this->__get('email'));
		$stmt->bindValue(':senha',$this->__get('senha'));
		$stmt->execute();
		return $this;
	}

	//Recuperartudo
	public function recuperar()
	{
		$query = 'select u.id, u.nome, u.email, u.senha, u.tipo, c.usuario_id from tb_usuarios as u left join tb_cursos as c on(c.usuario_id = u.id)';
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_OBJ);
	}

	//recuperarUsuario
	public function recuperarUsuario()
	{
		$query = 'select id,nome,email,senha, tipo from tb_usuarios where id = :id';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id',$this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	//Alterar
	public function alterar()
	{
		$query = 'update tb_usuarios set nome = :nome, email = :email, senha = :senha where id = :id';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome',$this->__get('nome'));
		$stmt->bindValue(':email',$this->__get('email'));
		$stmt->bindValue(':senha',$this->__get('senha'));
		$stmt->bindValue(':id',$this->__get('id'));
		$stmt->execute();
		
	}

	//excluir
    public function excluir()
    {
    	$query = 'delete from tb_usuarios where id = :id';
    	$stmt = $this->db->prepare($query);
    	$stmt->bindValue(':id',$this->__get('id'));
    	$stmt->execute();

    }

    //alterarCargo
    public function alterarCargo()
    {
    	$query = "update tb_usuarios set tipo = :tipo where id = :id";
    	$stmt = $this->db->prepare($query);
    	$stmt->bindValue(':id',$this->__get('id')); 
    	$stmt->bindValue(':tipo',$this->__get('tipo')); 
    	$stmt->execute();
    }

    public function recuperarCoord()
    {
    	$query = "select u.nome, u.id, u.tipo, c.usuario_id from tb_usuarios as u left join tb_cursos as c on (u.id = c.usuario_id) where u.tipo = 'Coordenador'";
    	$stmt = $this->db->prepare($query);
    	$stmt->execute();
    	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


	//Validar cadastro
	public function validarCadastro()
	{
	$valido = true;
	if(strlen($this->__get('nome')) == 0)
	{
		$valido = false;
	}
	if(strlen($this->__get('email')) == 0)
	{
		$valido = false;
	}
	if(strlen($this->__get('senha')) == 0)
	{
		$valido = false;
	}


	return $valido;
	}


	//Recuperar Usuario por e-mail
	public function getUsuarioPorEmail()
	{
		$query = "select nome, email from tb_usuarios where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email',$this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}


	//Autenticar
	public function autenticar()
	{
		$query = "select id,nome,email,tipo from tb_usuarios where email = :email and senha = :senha";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email',$this->__get('email'));
		$stmt->bindValue(':senha',$this->__get('senha'));
		$stmt->execute();

		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

		if($usuario)
		{
			if($usuario['id'] != '' && $usuario['nome'] != '')
			{
				$this->__set('id',$usuario['id']);
				$this->__set('nome',$usuario['nome']);
				$this->__set('tipo',$usuario['tipo']);

			}
		}

		return $this;
	}

}

?>