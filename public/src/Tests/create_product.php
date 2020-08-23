<?php
require_once __DIR__ . '/../../config/prolog.php';
use App\Entity\Product;

$productName = $argv[1];
$productPrice = $argv[2];
$product = new Product();
$product->setName($productName)
    ->setPrice(floatval($productPrice));

$entityManager->persist($product);
$entityManager->flush($product);

echo "Created Product with ID {$product->getId()} and price {$product->getPrice()} \n";
