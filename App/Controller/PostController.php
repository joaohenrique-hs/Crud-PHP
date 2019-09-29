<?php

class PostController
{
    public function index($params)
    {
        try {
            $postagem = Postagem::selectPostByID($params);
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');
            $parametros = array();
            $parametros['titulo'] = $postagem->titulo;
            $parametros['conteudo'] = $postagem->conteudo;
            $parametros['id_post'] = $postagem->id_post;
            $parametros['comentarios'] = $postagem->comentarios;
            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function coment()
    {
        try {
            $id = $_GET['id'];
            Comentario::createComent($_POST, $id);
            echo '<script>alert("Comentário inserido com sucesso!")</script>';
            echo '<script>location.href="http://localhost/Projetinho/?pagina=post&id=' . $id . '"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
            $id = $e->getCode();
            echo '<script>location.href="http://localhost/Projetinho/?pagina=post&id=' . $id . '"</script>';
        }
    }
}
