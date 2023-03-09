<?php 
namespace App\Models;
use MF\Model\Model;

class Arquivo extends Model 
{

  private $id;
  private $usuario_id;
  private $curso_id;
  private $descricao;
  private $arquivo;
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
  	$query = "insert into tb_arquivos(usuario_id,curso_id,descricao,arquivo) values (:usuario_id,:curso_id,:descricao,:arquivo)";
  	$stmt = $this->db->prepare($query);
  	$stmt->bindValue(':usuario_id',$this->__get('usuario_id'));
  	$stmt->bindValue(':curso_id',$this->__get('curso_id'));
  	$stmt->bindValue(':descricao',$this->__get('descricao'));
  	$stmt->bindValue(':arquivo',$this->__get('arquivo'));
  	$stmt->execute();

  	return $this;
  }

  public function recuperar()
  {
    $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
  
    $qtdPg = isset($_GET['qtdPg']) ? $_GET['qtdPg'] : 0;  

  	$query = 'select id,usuario_id,curso_id,descricao,arquivo,DATE_FORMAT(data_inclusao,"%d/%m/%Y %H:%i") as data_inclusao from tb_arquivos where curso_id = :curso_id order by data_inclusao desc ';
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

  public function recuperarArquivo()
  {
    $query = 'select id,usuario_id,curso_id,descricao,arquivo from tb_arquivos where id = :id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id',$this->__get('id'));
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);

  }

  public function alterar()
  {
    $query = 'update tb_arquivos set descricao = :descricao, arquivo = :arquivo where id = :id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id',$this->__get('id'));
     $stmt->bindValue(':descricao',$this->__get('descricao'));
      $stmt->bindValue(':arquivo',$this->__get('arquivo'));
    $stmt->execute();
  }

  public function excluir()
  {
    $query = 'delete from tb_arquivos where id = :id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id',$this->__get('id'));
    $stmt->execute();
  }

}


?>