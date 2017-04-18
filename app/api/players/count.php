<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/api/players/count', function(Request $request, Response $response) {
        try {
            // Connect to Db
            $db = Db::connect();

            // TODO: Move into class
            // Prepare
            $sql = "SELECT COUNT(*)
                    FROM players";
            $stmt = $db->prepare($sql);

            // No bind step necessary
            // Execute
            $stmt->execute();

            // Grab result
            $count = $stmt->fetch(PDO::FETCH_NUM);
            $data = array(
                "Success" => True,
                "Error" => False,
                "Message" => "Count successful",
                "Count" => intval($count[0])
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