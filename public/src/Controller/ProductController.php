<?php

namespace App\Controller;
use App\Service\Product\ProductListCreate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ProductController extends AbstractController
{
    /**
     * Вызывает сервис ProductListCreate
     * (Сервис создает стартовый набор продуктов)
     * @return JsonResponse
     */
    public function createProducts()
    {
        try {
            $service = new ProductListCreate($this->entityManager);
            $result = $service->execute();
            return new JsonResponse(['result' => ['productIdList' => $result]], Response::HTTP_OK);
        } catch (Throwable $exception) {
            return $this->handleException($exception);
        }
    }
}
