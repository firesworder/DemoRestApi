<?php
require_once getenv('PROJECT_DIR') . '/config/prolog.php';
use App\Service\Order\OrderCreate;
use App\AppContainer;
$entityManager = AppContainer::getEntityManager();

$productIds = explode(',',$argv[1]);
$service = new OrderCreate($entityManager);
echo $service->execute($productIds);

// php src/Tests/create_order_service.php 118,124,126
