<?php

namespace App\Controller;
use App\Service\Product\ProductListCreate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ProductController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createProducts()
    {
        try {
            $service = new ProductListCreate($this->entityManager);
            $result = $service->createProductList();
            return new JsonResponse(['result' => ['status' => $result]], Response::HTTP_OK);
        } catch (Throwable $exception) {
            return new JsonResponse(['error' => $exception->getMessage(), Response::HTTP_BAD_REQUEST]);
        }
    }
}
