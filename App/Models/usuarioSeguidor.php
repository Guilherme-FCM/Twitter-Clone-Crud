<?php

namespace App\Models;

use MF\Model\Model;

class UsuarioSeguidor extends Model {
  public function __get($attr){
    return $this->$attr;
  }

  public function __set($attr, $value){
    $this->$attr = $value;
  }

  public function seguirUsuario($id_usuario_seguindo){
    $query = "insert into usuarios_seguidores(id_usuario, id_usuario_seguindo) values(:id_usuario, :id_usuario_seguindo)";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(":id_usuario", $this->__get("id"));
    $stmt->bindValue(":id_usuario_seguindo", $id_usuario_seguindo);
    $stmt->execute();

    return true;
  }

  public function deixarSeguirUsuario($id_usuario_seguindo){
    $query = "delete from usuarios_seguidores where id_usuario = :id_usuario and id_usuario_seguindo = :id_usuario_seguindo";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(":id_usuario", $this->__get("id"));
    $stmt->bindValue(":id_usuario_seguindo", $id_usuario_seguindo);
    $stmt->execute();

    return true;
  }
}