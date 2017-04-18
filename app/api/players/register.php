<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->post('/api/players/register', function(Request $request, Response $response) {
        try {
            $db = Db::connect();

            // Prepare
            $sql = "INSERT INTO players (name)
                    VALUES (:name)";
            $stmt = $db->prepare($sql);

            // Bind
            $stmt->bindParam(':name', $name);
            $name = $request->getParam('name');

            // Execute
            $stmt->execute();

            $data = array(
                "Success" => True,
                "Error" => False,
                "Message" => "Player added"
            );

            return $response->withJson($data);
        } catch (PDOException $e) {
            $err = array(
                "Success" => False,
                "Error" => True,
                "Message" => $e->getMessage()
            );

            return $response->withJson($err);
        }
    });
?>