<?php

class Comentario
{
    public static function selecionaTodos($idPost)
    {
        $con = Connection::getCon();

        $sql = "SELECT * FROM comentario WHERE id_postagem = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject('Comentario')) {
            $resultado[] = $row;
        }
        return $resultado;
    }
    public function deleteComents($idPost)
    {
        $con = Connection::getCon();

        $sql = $con->prepare("DELETE FROM comentario WHERE id_postagem = :id");
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao deletar comentários!");
            return false;
        }
        return true;
    }
}