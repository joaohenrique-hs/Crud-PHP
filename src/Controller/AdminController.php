<?php

class AdminController
{
    public function create()
    {
        try {
            Post::create($_POST);
            http_response_code(200);
            echo json_encode(
                array("message" => "Post was created successfuly")
            );
        } catch (Exception $e) {
            var_dump($_POST);
            echo $e;
            http_response_code(503);
            echo json_encode(
                array("error" => "Server cannot handle with this request")
            );
        }
    }
    public function delete($params)
    {
        try {
            Comment::deleteComments($params);
            Post::delete($params);

            http_response_code(200);
            echo json_encode(
                array("message" => "Post was deleted successfuly")
            );
        } catch (Exception $e) {
            http_response_code(503);
            echo json_encode(
                array("error" => "Server cannot handle with this request")
            );
        }
    }
    public function update($params)
    {
        try {
            Post::update($_POST, $params);

            http_response_code(200);
            echo json_encode(
                array("message" => "Post was updated successfuly")
            );
        } catch (Exception $e) {
            http_response_code(503);
            echo json_encode(
                array("error" => "Server cannot handle with this request")
            );
        }
    }
}
