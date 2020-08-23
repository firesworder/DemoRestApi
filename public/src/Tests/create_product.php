<?php
require_once getenv('PROJECT_DIR') . '/config/prolog.php';
use App\Entity\Product;
use App\AppContainer;
$entityManager = AppContainer::getEntityManager();

$productName = $argv[1];
$productPrice = $argv[2];
$product = new Product();
$product->setName($productName)
    ->setPrice(floatval($productPrice));

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID {$product->getId()} and price {$product->getPrice()} \n";
