<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->post('/api/matches/report', function(Request $request, Response $response) {
        try {
            $db = Db::connect();

            // Prepare
            $sql = "INSERT INTO matches (round, winner, loser)
                    VALUES (:round, :winner, :loser)";
            $stmt = $db->prepare($sql);

            // Bind
            $stmt->bindParam(':round', $round);
            $stmt->bindParam(':winner', $winner);
            $stmt->bindParam(':loser', $loser);

            $round = $request->getParam('round');
            $winner = $request->getParam('winner');
            $loser = $request->getParam('loser');

            // Execute
            $stmt->execute();

            $data = array(
                "Success" => True,
                "Error" => False,
                "Message" => "Match has been reported"
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