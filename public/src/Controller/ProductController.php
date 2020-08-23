<?php

namespace App\Controller;
use App\Service\Product\ProductListCreate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ProductController extends AbstractController
{
    public function createProducts()
    {
        try {
            $service = new ProductListCreate($this->entityManager);
            $result = $service->createProductList();
            return new JsonResponse(['result' => ['status' => $result]], Response::HTTP_OK);
        } catch (Throwable $exception) {
            return $this->handleException($exception);
        }
    }
}
