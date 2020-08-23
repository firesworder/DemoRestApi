<?php


namespace App\Service\Order;


use App\Entity\{Order,Product};
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\InvalidArgumentException;

class OrderCreate
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
     * Создает заказ из переданных id продуктов.
     * @param array $productIdList id продуктов
     * @return int id созданного заказа
     */
    public function execute(array $productIdList) : int
    {
        if(empty($productIdList)) {
            throw new InvalidArgumentException('Массив ID продуктов не может быть пустым!');
        }

        $products = $this->entityManager->getRepository(Product::class)->findBy(['id' => $productIdList]);

        if (empty($products) || count($products) < count($productIdList)) {
            throw new InvalidArgumentException('Часть продуктов с переданными ID не существует');
        }

        $order = new Order();
        foreach($products as $product) {
            $order->addProduct($product);
        }
        $order->setStatus('New');

        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return $order->getId();
    }
}
