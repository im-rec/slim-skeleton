<?php

$app->get('/', function ($request, $response, $args) {
    return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode(['status'=>true, 'message'=>strtoupper(getenv("VERSION")).' Onedeca Service']));
});