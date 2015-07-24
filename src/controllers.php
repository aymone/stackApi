<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

/**
 * Index homepage
 */
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})->bind('homepage');

/**
 * Questions API
 * endpoint to be consumed
 */
$app->get('/api/v1/questions', function (Request $request) use ($app) {
    $em = $app['orm.em'];
    $questions = $app['db']->fetchAssoc($sql);
    $response = [
        'content' => [
            'status' => true,
            'get' => $request->query->all(),
            'questions' => $questions
        ]
    ];
    return new JsonResponse($response);
});

/**
 * Questions API
 * Save data from post
 */
$app->post('/api/v1/questions', function (Request $request) use ($app) {
    $questions = json_decode($request->getContent(), true);
    $response = [
        'content' => [
            'status' => true,
            'questions' => $questions
        ]
    ];
    return new JsonResponse($response);
});

/**
 * App Error handler
 */
$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/' . $code . '.html.twig',
        'errors/' . substr($code, 0, 2) . 'x.html.twig',
        'errors/' . substr($code, 0, 1) . 'xx.html.twig',
        'errors/default.html.twig',
    );
    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
