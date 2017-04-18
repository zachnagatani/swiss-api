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

            if ($players[0][0]->wins != $players[0][1]->wins) {
                $winner = $players[0][0];
                $data = array(
                    "Success" => True,
                    "Error" => False,
                    "Winner" => True,
                    "Info" => $winner
                );
            } else {
                $data = array(
                    "Success" => True,
                    "Error" => False,
                    "Winner" => False,
                    "Message" => "Here are the next rounds pairings",
                    "Pairings" => $players
                );
            }

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