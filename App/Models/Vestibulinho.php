<?php 
namespace App\Models;
use MF\Model\Model;

class Vestibulinho extends Model 
{
 
  private $id;
  private $imagem;

  public function __get($atributo)
  {
  	return $this->$atributo;
  }
  public function __set($atributo,$valor)
  {
  	$this->$atributo = $valor;
  }

  public function recuperar()
  {
    $query = 'select id,imagem from tb_vestibulinho';
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);

  }

  public function alterar()
  {
    $query = 'update tb_vestibulinho set imagem = :imagem';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':imagem',$this->__get('imagem'));
    $stmt->execute();
  }

 }


?>