<?php

class Postagem
{
    public static function selecionaTodos()
    {
        $con = Connection::getCon();

        $sql = "SELECT * FROM postagem ORDER BY id_post DESC";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject('Postagem')) {
            $resultado[] = $row;
        }
        if (!$resultado) {
            throw new Exception("Não há publicações");
        }
        return $resultado;
    }

    public static function selectPostByID($idPost)
    {
        $con = Connection::getCon();

        $sql = "SELECT * FROM postagem WHERE id_post = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Postagem');
        $comentario = array();
        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco");
        } else {
            $resultado->comentarios =  Comentario::selecionaTodos($resultado->id_post);
        }

        return $resultado;
    }
    public static function insert($dadosPost)
    {
        if (empty($dadosPost['titulo']) or empty($dadosPost['conteudo'])) {
            throw new Exception("Preencha os campos");
            return false;
        }
        //var_dump($dadosPost);


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
    }
    public static function delete($idPost)
    {
        $con = Connection::getCon();

        $sql = $con->prepare("DELETE FROM postagem WHERE id_post = :id");
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $res = $sql->execute();
        

        if ($res == 0) {
            throw new Exception("Falha ao deletar postagem!");
            return false;
        }

        return true;
    }
    public static function update($dadosPost, $idPost)
    {
        if (empty($dadosPost['titulo']) or empty($dadosPost['conteudo'])) {
            throw new Exception("Preencha os campos", $idPost);
            return false;
        }
        $con = Connection::getCon();
        
        $sql = $con->prepare("UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id_post = :id;");
        $sql->bindValue(':tit', $dadosPost['titulo']);
        $sql->bindValue(':cont', $dadosPost['conteudo']);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $res = $sql->execute();

        if ($res == 0) {
            throw new Exception("Falha ao alterar publicação");

            return false;
        }
    }
}
