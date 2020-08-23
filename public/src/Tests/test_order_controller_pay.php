<?php

require_once __DIR__ . '/../../config/prolog.php';
use App\Controller\OrderController;
use Symfony\Component\HttpFoundation\Request;

$orderId = $argv[1];
$paymentAmount = $argv[2];
$controller = new OrderController($entityManager);
$request = Request::create(
    '/test/',
    'POST',
    ['orderId' => $orderId, 'paymentAmount' => $paymentAmount]
);
echo $controller->payOrder($request);

// php src/Tests/test_order_controller_pay.php 6 1391
