<?php


namespace App;

use Doctrine\ORM\EntityManager,
    Symfony\Component\Yaml\Yaml,
    Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\ORMException;

/**
 * Реализация container для DI.
 * Class AppContainer
 * @package App
 */
class AppContainer
{
    /**
     * @var EntityManager
     */
    private static $entityManager;

    /**
     * Инциализирует сущности контейнера(в д.с. только EntityManager)
     * @param string $projectDir root директория проекта
     * @throws ORMException
     */
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

    /**
     * Возвращает EntityManager из контейнера
     * @return EntityManager
     */
    public static function getEntityManager()
    {
        return self::$entityManager;
    }
}
