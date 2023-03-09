<?php 
namespace App\Models;
use MF\Model\Model;

class Estagio extends Model 
{


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
    $query = 'select id,estagio,empresa from tb_estagio';
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);

  }

  public function alterarEstagio()
  {
    $query = 'update tb_estagio set estagio = :estagio';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':estagio',$this->__get('estagio'));
    $stmt->execute();
  }
   public function alterarEmpresa()
  {
    $query = 'update tb_estagio set empresa = :empresa';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':empresa',$this->__get('empresa'));
    $stmt->execute();
  }

}

?>