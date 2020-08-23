<?php
require_once __DIR__ . '/../../config/prolog.php';
use Symfony\Component\HttpFoundation\Request;
use App\Kernel;

$request = Request::create(
    '/product/create-products',
    'POST'
);

$request->overrideGlobals();

$app = new Kernel();
$app->execute();

// php src/Tests/test_kernel_create_product.php
