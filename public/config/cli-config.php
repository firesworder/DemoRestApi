<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'prolog.php';

return ConsoleRunner::createHelperSet($entityManager);
