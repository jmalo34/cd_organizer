<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/CD.php";

    session_start();

    if (empty($_SESSION[collection]))
    {
        $_SESSION['collection'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function () use ($app)
    {
        return $app['twig']->render('cds.html.twig', array('albums' => CD::getAll()));
    });

    $app->get('/new_cd', function () use ($app)
    {
        return $app['twig']->render('new_cd.html.twig');
    });

    $app->post('/new_cd', function () use ($app)
    {
        $new_album = new CD($_POST['title']);
        $new_album->save();

        return $app['twig']->render('cds.html.twig', array('album' => $new_album));
    });

    $app->post('/delete_cds', function () use ($app)
    {
        CD::deleteAll();

        return $app['twig']->render('delete_cds.html.twig');
    });

    return $app;

 ?>
