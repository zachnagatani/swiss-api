<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require '../vendor/autoload.php';

    $app = new \Slim\App;

    // Db Connection
    require_once('../app/db/db.php');

    // API Hooks
    require_once('../app/api/matches/index.php');

    $app->run();
?>