<?php
require_once getenv('PROJECT_DIR') . '/config/prolog.php';
use App\Controller\ProductController;
use Symfony\Component\HttpFoundation\Request;

$controller = new ProductController($entityManager);
//Здесь request для самого контроллера не нужен
echo $controller->createProducts();

// php src/Tests/test_product_controller.php
