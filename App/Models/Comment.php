<?php

class Comment
{
    public static function selectAll($idPost)
    {
        try {
            $con = Connection::getCon();

            $sql = "SELECT * FROM comentario WHERE id_postagem = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('Comment')) {
                $resultado[] = $row;
            }

            return $resultado;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function createComment($dadosComment, $idPost)
    {
        try {
            if (empty($dadosComment['titulo']) or empty($dadosComment['conteudo'])) {
                throw new Exception("Preencha os campos", $idPost);
            }

            $con = Connection::getCon();

            $sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:tit, :cont, :id);";
            $sql = $con->prepare($sql);
            $sql->bindValue(':tit', $dadosComment['titulo']);
            $sql->bindValue(':cont', $dadosComment['conteudo']);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $res = $sql->execute();

            if ($res == 0) {
                throw new Exception("Fail to insert comment, $idPost");
            }
            return "Comment was created succesfuly";
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function deleteComments($idPost)
    {
        try {
            $con = Connection::getCon();

            $sql = $con->prepare("DELETE FROM comentario WHERE id_postagem = :id");
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $res = $sql->execute();

            if ($res == 0) {
                throw new Exception("Fail to insert comments");
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
