<?php


namespace App\Service\Product;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductListCreate
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Создает набор продуктов и возвращает их id
     * @return array результат операция создания продуктов (успех/неудача)
     */
    public function execute(): array
    {
        $products = [];
        // Рандомно сгенерировать 20 записей продуктов в бд
        for ($i = 0; $i < 20; $i += 1) {
            $product = new Product();
            $product->setName('Product_' . rand())
                ->setPrice(rand(1, 1000));
            $this->entityManager->persist($product);
            $products[] = $product;
        }
        unset($product);

        $this->entityManager->flush();
        $this->entityManager->clear();

        return array_map(function($product) { return $product->getId(); }, $products);
    }
}
