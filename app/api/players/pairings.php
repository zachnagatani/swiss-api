<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/api/players/pairings', function(Request $request, Response $response) {
        try {
            $db = Db::connect();

            // Prepare
            $sql = "SELECT *
                    FROM players
                    ORDER BY wins DESC";
            $stmt = $db->prepare($sql);

            // No binding necessary

            // Execute
            $stmt->execute();

            $players = $stmt->fetchAll(PDO::FETCH_OBJ);
            $players = array_chunk($players, 2);

            $data = array(
                "Success" => True,
                "Error" => False,
                "Message" => "Player added",
                "Standings" => $players
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