<?php
/**
 * Скрипт для работы doctrine/orm из cli
 */
require_once 'prolog.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use App\AppContainer;

$entityManager = AppContainer::getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
