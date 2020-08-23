<?php

require_once __DIR__ . '/../../config/prolog.php';
use App\Controller\OrderController;
use Symfony\Component\HttpFoundation\Request;

$productIdList = explode(',',$argv[1]);
$controller = new OrderController($entityManager);
$request = Request::create(
    '/test/',
    'POST',
    ['productIdList' => $productIdList]
);
echo $controller->createOrder($request);

// php src/Tests/test_order_controller_create.php 107,108
