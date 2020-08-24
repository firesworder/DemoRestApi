<?php


namespace App\Controller;

use App\AppContainer;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct()
    {
        $this->entityManager = AppContainer::getEntityManager();
    }

    /**
     * Получает параметры исключения и формирует из сообщения и кода json response
     * Message - error в массиве json, Code - статус ответа(BAD_REQUEST) если код не передан
     * @param Exception $exception
     * @return JsonResponse в формате ['error' => exceptMessage]
     */
    protected function handleException(Exception $exception)
    {
        $status = $exception->getCode() ? $exception->getCode() : Response::HTTP_BAD_REQUEST;
        return new JsonResponse(['error' => $exception->getMessage()], $status);
    }
}
