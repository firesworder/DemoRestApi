<?php
require_once getenv('PROJECT_DIR') . '/config/prolog.php';
use App\Entity\{Order, Product};

$productIdList = explode(',',$argv[1]);
$orderStatus = $argv[2];
$order = new Order();
foreach ($productIdList as $productId) {
    $product = $entityManager->find(Product::class, $productId);
    $order->addProduct($product);
}
$order->setStatus($orderStatus);

$entityManager->persist($order);
$entityManager->flush();

echo "Created order with ID {$order->getId()} and status {$order->getStatus()} \n";
foreach ($order->getProducts() as $product) {
    echo $product->getName();
}
//php src/Tests/create_order.php 1,2 New
