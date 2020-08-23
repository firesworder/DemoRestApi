<?php
require_once getenv('PROJECT_DIR') . '/config/prolog.php';
use App\Service\Product\ProductListCreate;
use App\Entity\Product;
use App\AppContainer;
$entityManager = AppContainer::getEntityManager();

$service = new ProductListCreate($entityManager);
echo 'Result is ' . $service->createProductList();

echo 'Count: ' . $entityManager->getRepository(Product::class)
    ->count([]);
// php src/Tests/create_products_service.php
