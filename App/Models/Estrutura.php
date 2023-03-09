<?php 
namespace App\Models;
use MF\Model\Model;

class Estrutura extends Model 
{
 
  private $id;
  private $descricao;

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
    $query = 'select id,descricao from tb_estrutura';
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function alterarEstrutura()
  {
    $query = 'update tb_estrutura set descricao = :descricao';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':descricao',$this->__get('descricao'));
    $stmt->execute();
  }


}

?>