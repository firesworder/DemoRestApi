<?php
if(!defined('ROOT_PATH')) define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/vendor/autoload.php';

use Doctrine\ORM\EntityManager,
    Symfony\Component\Yaml\Yaml,
    Doctrine\ORM\Tools\Setup;

$config = Setup::createAnnotationMetadataConfiguration(array(ROOT_PATH . "/src/Entity"), true, null, null, false);
$conn = Yaml::parseFile(ROOT_PATH . '/config/db_params.yaml')['parameters'];

$entityManager = EntityManager::create($conn, $config);
