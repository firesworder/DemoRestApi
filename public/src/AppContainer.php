<?php


namespace App;

use Doctrine\ORM\EntityManager,
    Symfony\Component\Yaml\Yaml,
    Doctrine\ORM\Tools\Setup;

class AppContainer
{
    private static $entityManager;

    public static function init(string $projectDir)
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            array($projectDir . "/src/Entity"),
            true,
            null,
            null,
            false
        );
        $conn = Yaml::parseFile($projectDir . '/config/db_params.yaml')['parameters'];

        self::$entityManager = EntityManager::create($conn, $config);
    }

    public static function getEntityManager()
    {
        return self::$entityManager;
    }
}
