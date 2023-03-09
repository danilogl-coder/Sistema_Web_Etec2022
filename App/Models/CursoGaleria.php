<?php 
namespace App\Models;
use MF\Model\Model;

class CursoGaleria extends Model 
{

private $id;
private $curso_id;
private $usuario_id;
private $imagem;
private $legenda;
private $data_inclusao;

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
 	$query = "insert into tb_cursogaleria(curso_id,usuario_id,imagem,legenda) values(:curso_id,:usuario_id,:imagem,:legenda)";
 	$stmt = $this->db->prepare($query);
 	$stmt->bindValue(':curso_id',$this->__get('curso_id'));
 	$stmt->bindValue(':usuario_id',$this->__get('usuario_id'));
 	$stmt->bindValue(':imagem',$this->__get('imagem'));
 	$stmt->bindValue(':legenda',$this->__get('legenda'));
 	$stmt->execute();
 	return $this;
 }

 public function recuperar()
 {
    $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
  
    $qtdPg = isset($_GET['qtdPg']) ? $_GET['qtdPg'] : 0;  

    $query = "select id,curso_id,usuario_id,imagem,legenda, DATE_FORMAT(data_inclusao,'%d/%m/%Y %H:%i') as data_inclusao from tb_cursogaleria where curso_id = :curso_id order by data_inclusao desc ";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':curso_id',$this->__get('curso_id'));
    $stmt->execute();
    $max = $stmt->rowCount();

    if($qtdPg > 0)
    {
      $query.="limit $offset, $qtdPg";
    }

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':curso_id',$this->__get('curso_id'));
    $stmt->execute();

    $regs = $stmt->fetchAll();
    return ["qt" => $max,"offset"=> $offset, "regs"=> $regs];
 }

 public function excluir()
 {
    $query = "delete from tb_cursogaleria where id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id',$this->__get('id'));
    $stmt->execute();

 }
}
