<?php

class AdminController
{
    public function index()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('admin.html');

            $parametros = array();
            $objPostagens = Postagem::selecionaTodos();
            $parametros['postagens'] = $objPostagens;

            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            $parametros['postagens'] = $objPostagens;

            $conteudo = $template->render($parametros);
            echo $conteudo;
            echo '<h2>' . $e->getMessage();
            '</h2>';
        }
    }
    public function create()
    {
        $loader = new \Twig\Loader\FilesystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = array();

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }
    public function insert()
    {
        try {
            Postagem::insert($_POST);

            echo '<script>alert("Publicação inserida com sucesso!")</script>';
            echo '<script>location.href="http://localhost/Admin"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
            echo '<script>location.href="http://localhost/Admin/create"</script>';
        }
    }
    public function delete($params)
    {
        try {
            Comentario::deleteComents($params);
            Postagem::delete($params);

            echo '<script>alert("Publicação deletada com sucesso!")</script>';
            echo '<script>location.href="http://localhost/Admin"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
            echo '<script>location.href="http://localhost/Admin"</script>';
        }
    }
    public function alter($params)
    {
        $postagem = Postagem::selectPostByID($params);
        $loader = new \Twig\Loader\FilesystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $parametros = array();
        $parametros['titulo'] = $postagem->titulo;
        $parametros['conteudo'] = $postagem->conteudo;
        $parametros['id_post'] = $postagem->id_post;

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }
    public function update($params)
    {
        try {
            Postagem::update($_POST, $params);
            echo '<script>alert("Publicação alterada com sucesso!")</script>';
            echo '<script>location.href="http://localhost/Admin"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
            $id = $e->getCode();
            echo '<script>location.href="http://localhost/Admin/alter/' . $id . '"</script>';
        }
    }
}
