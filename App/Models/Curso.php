<?php 
namespace App\Models;
use MF\Model\Model;

class Curso extends Model 
{
  private $id;
  private $usuario_id;
  private $curso_id; 
  /* ^-Isso tá aqui para eu poder excluir tudo relacionado a cursos*/ 
  private $titulo;
  private $logotipo;
  private $capa;
  private $descricao;

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
    $query = 'insert into tb_cursos(titulo,logotipo,capa,descricao) values(:titulo,:logotipo,:capa,:descricao)';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':titulo',$this->__get('titulo'));
    $stmt->bindValue(':logotipo',$this->__get('logotipo'));
    $stmt->bindValue(':capa',$this->__get('capa'));
    $stmt->bindValue(':descricao',$this->__get('descricao'));

    $stmt->execute();

    return $this;
  }

  public function recuperar()
  {
    $query = 'select c.id, c.usuario_id, c.titulo, c.logotipo, c.capa, c.descricao, u.nome from tb_cursos as c left join tb_usuarios as u on(c.usuario_id = u.id)';
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }


  public function recuperarCurso()
  {
    $query = 'select id, usuario_id, titulo, logotipo, capa, descricao from tb_cursos where id = :id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id',$this->__get('id'));
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);

  }

  public function alterar()
  {
    $query = 'update tb_cursos set usuario_id = :usuario_id, titulo = :titulo, logotipo = :logotipo, capa = :capa, descricao = :descricao where id = :id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id',$this->__get('id'));
    $stmt->bindValue(':usuario_id',$this->__get('usuario_id'));
    $stmt->bindValue(':titulo',$this->__get('titulo'));
    $stmt->bindValue(':logotipo',$this->__get('logotipo'));
    $stmt->bindValue(':capa',$this->__get('capa'));
    $stmt->bindValue(':descricao',$this->__get('descricao'));
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function excluir()
  {

    $query = 'delete from tb_publicacao where curso_id = :curso_id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':curso_id',$this->__get('curso_id'));
    $stmt->execute();

    $query = 'delete from tb_arquivos where curso_id = :curso_id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':curso_id',$this->__get('curso_id'));
    $stmt->execute();

    $query = 'delete from tb_cursogaleria where curso_id = :curso_id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':curso_id',$this->__get('curso_id'));
    $stmt->execute();

    $query = 'delete from tb_cursos where id = :id';
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id',$this->__get('id'));
    $stmt->execute();
    
  }
}
?>