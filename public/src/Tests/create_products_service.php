<?php
require_once __DIR__ . '/../../config/prolog.php';
use App\Service\Product\ProductListCreate;
use App\Entity\Product;

$service = new ProductListCreate($entityManager);
echo 'Result is ' . $service->createProductList();

echo 'Count: ' . $entityManager->getRepository(Product::class)
    ->count([]);
// php src/Tests/create_products_service.php
