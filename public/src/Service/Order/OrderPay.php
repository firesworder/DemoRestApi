<?php


namespace App\Service\Order;


use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Client;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

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
            throw new InvalidArgumentException('Заказа с таким id не существует');
        }

        if($order->getStatus() !== Order::ORDER_NEW_STATUS) {
            throw new Exception(
                'Для возможности оплаты заказа он должен иметь статус "New"(новый)',
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $orderProducts = $order->getProducts();

        $orderAmount = 0;
        foreach ($orderProducts as $product) {
            $orderAmount += $product->getPrice();
        }

        if($orderAmount !== $moneyAmount) {
            throw new InvalidArgumentException(
                'Сумма оплаты заказа не равна стоимости заказа',
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $httpClient = new Client();
        $paymentConfirmationStatus = $httpClient->request('GET', 'ya.ru')
            ->getStatusCode();

        if($paymentConfirmationStatus !== 200) {
            throw new Exception('Не удалось получить подтверждение от платежной системы',Response::HTTP_EXPECTATION_FAILED);
        }

        $order->setStatus('Payed');
        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return true;
    }
}
