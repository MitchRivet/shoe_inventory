<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Shoe.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'

    ));

    $app->get("/shoes", function() use ($app) {
        return $app['twig']->render('shoes.html.twig');
    });

    $app->get("/shoes", function() use ($app) {
        return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll()));
    });

    $app->post("/shoes", function() use ($app) {
        $shoe = new Shoe($_POST['brand'], $_POST['color']);
        $shoe->save();
        return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll()));
    });

    $app->post("/delete_shoes", function() use ($app) {
        Shoe::deleteAll();
        return $app['twig']->render('shoes.html.twig');
    });

    return $app;
?>
