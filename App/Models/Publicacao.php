<?php 
namespace App\Models;
use MF\Model\Model;

class Publicacao extends Model 
{
 private $id;
 private $usuario_id;
 private $curso_id;
 private $titulo;
 private $descricao;
 private $imagem;
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
 	$query = "insert into tb_publicacao(usuario_id,curso_id,titulo,descricao,imagem) values(:usuario_id,:curso_id,:titulo,:descricao,:imagem)";
 	$stmt = $this->db->prepare($query);
 	$stmt->bindValue(':usuario_id',$this->__get('usuario_id'));
 	$stmt->bindValue(':curso_id',$this->__get('curso_id'));
 	$stmt->bindValue(':titulo',$this->__get('titulo'));
 	$stmt->bindValue(':descricao',$this->__get('descricao'));
  $stmt->bindValue(':imagem',$this->__get('imagem'));
 	$stmt->execute();

 	return $this;
 }

  public function recuperarPagina()
 {
    $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
  
    $qtdPg = isset($_GET['qtdPg']) ? $_GET['qtdPg'] : 0;  

    $query ='select id, usuario_id,curso_id,titulo,descricao,imagem,DATE_FORMAT(data_inclusao,"%d/%m/%Y %H:%i") as data_inclusao from tb_publicacao where curso_id = :curso_id order by data_inclusao desc ';
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

 public function recuperarPaginaId()
 {
  $query = 'select id,titulo,descricao,imagem from tb_publicacao where id = :id';
  $stmt = $this->db->prepare($query);
  $stmt->bindValue(':id',$this->__get('id'));
  $stmt->execute();
  return $stmt->fetch(\PDO::FETCH_ASSOC);

 }
 public function recuperarAllPagina()
 {
   $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
  
   $qtdPg = isset($_GET['qtdPg']) ? $_GET['qtdPg'] : 0;  

    $query ='select p.id, p.usuario_id,p.curso_id,p.titulo,p.descricao,p.imagem,DATE_FORMAT(data_inclusao,"%d/%m/%Y %H:%i") as data_inclusao, c.logotipo from tb_publicacao as p left join tb_cursos as c on (p.curso_id = c.id) order by data_inclusao desc ';
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $max = $stmt->rowCount();

    if($qtdPg > 0)
    {
      $query.="limit $offset, $qtdPg";
    }

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    $regs = $stmt->fetchAll();

    return ['qt'=> $max,'offset'=> $offset,'regs'=> $regs];


 }

 public function alterar()
 {
  $query = "update tb_publicacao set titulo = :titulo, descricao = :descricao, imagem = :imagem where id = :id";
  $stmt = $this->db->prepare($query);
  $stmt->bindValue(':id',$this->__get('id'));
  $stmt->bindValue(':titulo',$this->__get('titulo'));
  $stmt->bindValue(':descricao',$this->__get('descricao'));
  $stmt->bindValue(':imagem',$this->__get('imagem'));
  $stmt->execute();
 }



 public function excluir()
 {
  $query = "delete from tb_publicacao where id = :id";
  $stmt = $this->db->prepare($query);
  $stmt->bindValue(':id',$this->__get('id'));
  $stmt->execute();

 }



}
?>