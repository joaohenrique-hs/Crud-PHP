<?php

class HomeController
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
}
