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
        $album = new CD($_POST['title'], $_POST['artist']);
        $album->save();

        return $app['twig']->render('cds.html.twig', array('albums' => CD::getAll()));
    });

    $app->get('/searchbyartist', function () use ($app)
    {
        return $app['twig']->render('searchbyartist.html.twig');
    });

    $app->get('/search_results', function () use ($app)
    {
        $albums = CD::getAll();

        $catalog = array();

        foreach ($albums as $album)
        {
            if ($album->artistSearch($_GET['artist_search']))
            {
                array_push($catalog, $album);
            }
        }

        return $app['twig']->render('search_results.html.twig', array('catalog' => $catalog));
    });

    $app->post('/delete_cds', function () use ($app)
    {
        CD::deleteAll();

        return $app['twig']->render('delete_cds.html.twig');
    });

    return $app;

 ?>
