<?php
require_once getenv('PROJECT_DIR') . '/config/prolog.php';
use Symfony\Component\HttpFoundation\Request;
use App\Kernel;
use App\AppContainer;
$entityManager = AppContainer::getEntityManager();

$request = Request::create(
    '/product/create-products',
    'POST'
);

$request->overrideGlobals();

$app = new Kernel();
$app->execute();

// php src/Tests/test_kernel_create_product.php
