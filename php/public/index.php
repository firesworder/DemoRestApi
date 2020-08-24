<?php
require_once 'config/prolog.php';

use App\Kernel;

$app = new Kernel();
try {
    $app->execute();
} catch (Exception $e) {
    echo 'Произошла ошибка. Попробуйте обратиться позднее';
}
