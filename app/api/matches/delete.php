<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->delete('/api/matches/delete', function(Request $request, Response $response) {
        try {
            $db = Db::connect();

            // Prepare
            $sql = "DELETE FROM matches";
            $stmt = $db->prepare($sql);

            // No bind step necessary here

            // Execute
            $stmt->execute();

            $data = array(
                "Success" => True,
                "Error" => False,
                "Message" => "Matches deleted"
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