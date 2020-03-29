<?php

class PostController
{
    public function index()
    {
        try {
            $postagens = Post::selectAll();
            http_response_code(200);
            echo json_encode($postagens);
        } catch (Exception $e) {
            http_response_code(503);
            echo json_encode(
                array("error" => "Server cannot handle with this request")
            );
        }
    }

    public function select($params)
    {
        try {
            $postagem = Post::selectPostByID($params);
            http_response_code(200);

            echo json_encode($postagem);
        } catch (Exception $e) {
            http_response_code(503);

            echo json_encode(
                array("error" => "Server cannot handle this request")
            );
        }
    }

    public function comment($id)
    {
        try {
            $content = Comment::createComment($_POST, $id);
            http_response_code(200);
            echo json_encode(
                array("message" => $content)
            );
        } catch (Exception $e) {
            var_dump($_POST);
            http_response_code(503);
            echo json_encode(
                array("error" => "Server cannot handle with this request")
            );
        }
    }
}
