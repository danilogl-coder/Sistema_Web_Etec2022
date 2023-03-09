<?php 
namespace App\Models;
use MF\Model\Model;

class EstagioArquivo extends Model 
{

  private $id;
  private $estagio_id;
  private $descricao;
  private $arquivo;

  public function __get($atributo)
  {
  	return $this->$atributo;
  }
  public function __set($atributo,$valor)
  {
  	$this->$atributo = $valor;
  }

  public function inserir()
  {
    $query = 'insert into tb_estagioarquivos(estagio_id,descricao,arquivo) values(:estagio_id,:descricao,:arquivo)';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':estagio_id',$this->__get('estagio_id'));
    $stmt->bindValue(':descricao',$this->__get('descricao'));
    $stmt->bindValue(':arquivo',$this->__get('arquivo'));
    $stmt->execute();
    return $this;
  }
  public function recuperar()
  {
    $query = 'select id,estagio_id,descricao,arquivo from tb_estagioarquivos';
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function recuperarArquivo()
  {
    $query = 'select id,estagio_id,descricao,arquivo from tb_estagioarquivos where id = :id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id',$this->__get('id'));
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function excluir()
  {
    $query = 'delete from tb_estagioarquivos where id = :id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id',$this->__get('id'));
    $stmt->execute();
  }


}

?>