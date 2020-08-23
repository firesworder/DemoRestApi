<?php
require_once 'config/prolog.php';

use App\Kernel;

$app = new Kernel();
$app->execute();
