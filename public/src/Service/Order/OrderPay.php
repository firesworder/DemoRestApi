<?php


namespace App\Service\Order;


use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Client;
use InvalidArgumentException;

class OrderPay
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(int $id, float $moneyAmount) : bool
    {
        $order = $this->entityManager->getRepository(Order::class)
            ->find($id);

        if($order === null) {
            throw new InvalidArgumentException('Заказ с таким id не существует');
        }
        $orderProducts = $order->getProducts();

        $orderAmount = 0;
        foreach ($orderProducts as $product) {
            $orderAmount += $product->getPrice();
        }

        if($orderAmount !== $moneyAmount) {
            throw new Exception('Сумма оплаты заказа меньше стоимости заказа');
        }

        $httpClient = new Client();
        $paymentConfirmationStatus = $httpClient->request('GET', 'ya.ru')
            ->getStatusCode();

        if($paymentConfirmationStatus !== 200) {
            throw new Exception('Не удалось получить подтверждение от платежной системы');
        }

        $order->setStatus('Payed');
        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return true;
    }
}
