<?php

require_once getenv('PROJECT_DIR') . '/config/prolog.php';
use App\Controller\OrderController;
use Symfony\Component\HttpFoundation\Request;
use App\AppContainer;
$entityManager = AppContainer::getEntityManager();

$productIdList = explode(',',$argv[1]);
$controller = new OrderController($entityManager);
$request = Request::create(
    '/test/',
    'POST',
    ['productIdList' => $productIdList]
);
echo $controller->createOrder($request);

// php src/Tests/test_order_controller_create.php 107,108
