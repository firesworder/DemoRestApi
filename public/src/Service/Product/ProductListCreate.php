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
     * TODO: не знаю, что вернуть стоит, либо список продуктов созданных, либо просто статус успех/неудача
     * @return bool результат операция создания продуктов (успех/неудача)
     */
    public function createProductList() : bool
    {
        for($i = 0; $i<20; $i+=1) {
            $product = new Product();
            $product->setName('Product_' . rand())
                ->setPrice(rand(0,1000));
            $this->entityManager->persist($product);
        }
        unset($product);

        $this->entityManager->flush();
        $this->entityManager->clear();

        //TODO: возможно стоило бы проверить, что оно добавилось все
        return true;
    }
}
