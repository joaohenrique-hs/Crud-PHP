<?php

class Post
{
    public static function selectAll()
    {
        try {
            $con = Connection::getCon();

            $sql = "SELECT * FROM postagem ORDER BY id_post DESC";
            $sql = $con->prepare($sql);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('Post')) {
                $resultado[] = $row;
            }

            if (!$resultado) {
                $resultado = array("message" => "None Post");
            }
            return $resultado;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function selectPostByID($idPost)
    {
        try {
            $con = Connection::getCon();

            $sql = "SELECT * FROM postagem WHERE id_post = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetchObject('Post');
            $comentario = array();

            if (!$resultado) {
                throw new Exception("This post don't exists");
            } else {
                $resultado->comentarios =  Comment::selectAll($resultado->id_post);
            }

            return $resultado;
        } catch (Exception $e) {
            return "This post is not accessible";
        }
    }
    public static function create($dadosPost)
    {
        try {
            if (empty($dadosPost['titulo']) or empty($dadosPost['conteudo'])) {
                throw new Exception("Preencha os campos");
                return false;
            }

            $con = Connection::getCon();

            $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont);";
            $sql = $con->prepare($sql);
            $sql->bindValue(':tit', $dadosPost['titulo']);
            $sql->bindValue(':cont', $dadosPost['conteudo']);
            $res = $sql->execute();

            if ($res == 0) {
                throw new Exception("Falha ao inserir publicação");

                return false;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function delete($idPost)
    {
        try {
            $con = Connection::getCon();

            $sql = $con->prepare("DELETE FROM postagem WHERE id_post = :id");
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $res = $sql->execute();


            if ($res == 0) {
                throw new Exception("Fail to delete Post");
                return false;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function update($dadosPost, $idPost)
    {
        try {
            if (empty($dadosPost['titulo']) or empty($dadosPost['conteudo'])) {
                throw new Exception("Invalid attempt", $idPost);
                return false;
            }
            $con = Connection::getCon();

            $sql = $con->prepare("UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id_post = :id;");
            $sql->bindValue(':tit', $dadosPost['titulo']);
            $sql->bindValue(':cont', $dadosPost['conteudo']);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $res = $sql->execute();

            if ($res == 0) {
                throw new Exception("Fail to update Post");

                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
