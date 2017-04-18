<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->post('/api/matches/report', function(Request $request, Response $response) {
        try {
            $db = Db::connect();

            // Variables from POST values
            $round = $request->getParam('round');
            $winner = $request->getParam('winner');
            $loser = $request->getParam('loser');

            // Array of sql statements, empty initially
            $stmts = array();
            // Prepare
            $sql = "INSERT INTO matches (round, winner, loser)
                    VALUES (:round, :winner, :loser)";
            $stmt = $db->prepare($sql);
            array_push($stmts, $stmt);

            // Bind
            $stmt->bindParam(':round', $round);
            $stmt->bindParam(':winner', $winner);
            $stmt->bindParam(':loser', $loser);

            // Update players' records

            // Winner
            // Prepare
            $sql = "UPDATE players
                    SET wins = wins + 1
                    WHERE id = :winner";
            $stmt = $db->prepare($sql);
            array_push($stmts, $stmt);

            // Bind
            $stmt->bindParam(':winner', $winner);

            // Loser
            // Prepare
            $sql = "UPDATE players
                    SET losses = losses + 1
                    WHERE id = :loser";
            $stmt = $db->prepare($sql);

            // Bind
            $stmt->bindParam(':loser', $loser);
            array_push($stmts, $stmt);

            // Loop through $stmts and execute each one
            foreach($stmts as $stmt) {
                $stmt->execute();
            }

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