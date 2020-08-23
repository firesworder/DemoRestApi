<?php


namespace App;

use Doctrine\ORM\EntityManager,
    Symfony\Component\Yaml\Yaml,
    Doctrine\ORM\Tools\Setup;

class EntityManagerContainer
{
    private $entityManager;

    public function __construct(string $rootProjectDir)
    {
        $config = Setup::createAnnotationMetadataConfiguration(array($rootProjectDir . "/src/Entity"), true, null, null, false);
        $conn = Yaml::parseFile($rootProjectDir . '/config/db_params.yaml')['parameters'];

        $this->entityManager = EntityManager::create($conn, $config);
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
