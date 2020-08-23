<?php
require_once getenv('PROJECT_DIR') . '/config/prolog.php';

use App\Service\Order\OrderPay;

$orderId = $argv[1];
$moneyAmount = $argv[2];
$service = new OrderPay($entityManager);
echo $service->execute($orderId, $moneyAmount);

// php src/Tests/pay_order_service.php 5 1363
