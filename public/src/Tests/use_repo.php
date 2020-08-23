<?php
require_once __DIR__ . '/../../config/prolog.php';
use App\Entity\{Product, Order};

$products = $entityManager->getRepository(Product::class)->getEcho();
$orders = $entityManager->getRepository(Order::class)->getEcho();
//php src/Tests/use_repo.php
