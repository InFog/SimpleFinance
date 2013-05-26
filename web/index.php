<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\Slim(array(
    'templates.path' => __DIR__ . '/../templates'
));

\Slim\Extras\Views\Twig::$twigOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../templates/cache')
);
$app->view(new \Slim\Extras\Views\Twig());

$app->get('/', function () use ($app) {
    $app->render('index.html.twig');
});

$app->run();
