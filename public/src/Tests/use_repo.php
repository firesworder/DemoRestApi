<?php
require_once getenv('PROJECT_DIR') . '/config/prolog.php';

use App\Entity\{Product, Order};
use App\AppContainer;
$entityManager = AppContainer::getEntityManager();

$products = $entityManager->getRepository(Product::class)->getEcho();
$orders = $entityManager->getRepository(Order::class)->getEcho();
//php src/Tests/use_repo.php
