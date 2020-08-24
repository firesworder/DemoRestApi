<?php


namespace App\Service\Order;


use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class OrderPay
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Order
     */
    private $order;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Оплачивает заказ(переводя статус из New в Payed)
     * @param int $orderId id Заказа
     * @param float $moneyAmount сумма для оплаты заказа
     * @return bool результат операции (true - если успешно, иначе исключение с причинами "провала" операции)
     * @throws GuzzleException
     */
    public function execute(int $orderId, float $moneyAmount): bool
    {
        $this->order = $this->entityManager->getRepository(Order::class)
            ->find($orderId);

        //Проверить данные по заказу до процесса оформления. Если возникнет ошибка - будет получено исключение
        $this->validatePayRequest($moneyAmount);

        //Провести операцию оплаты в платежной системе
        $httpClient = new Client();
        $paymentConfirmationStatus = $httpClient->request('GET', 'ya.ru')
            ->getStatusCode();

        //Если платежная система "не подтвердила" - выбросить исключение
        if ($paymentConfirmationStatus !== 200) {
            throw new Exception(
                'Не удалось получить подтверждение от платежной системы',
                Response::HTTP_EXPECTATION_FAILED
            );
        }

        $this->order->setStatus('Payed');
        $this->entityManager->persist($this->order);
        $this->entityManager->flush();

        return true;
    }

    /**
     * @param float $moneyAmount
     * @throws Exception
     */
    private function validatePayRequest(float $moneyAmount)
    {
        //Если не найдено заказа с таким id
        if ($this->order === null) {
            throw new InvalidArgumentException('Заказа с таким id не существует');
        }

        //Если статус заказа отличается от NEW(оплачиваться могут заказы только с таким статусом)
        if ($this->order->getStatus() !== Order::ORDER_NEW_STATUS) {
            throw new Exception(
                'Для возможности оплаты заказа он должен иметь статус "New"(новый)',
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $orderProducts = $this->order->getProducts();

        $orderAmount = 0;
        foreach ($orderProducts as $product) {
            $orderAmount += $product->getPrice();
        }

        //Если расходятся переданная сумма оплаты заказа и стоимости заказа
        if ($orderAmount !== $moneyAmount) {
            throw new InvalidArgumentException(
                'Сумма оплаты заказа не равна стоимости заказа',
                Response::HTTP_NOT_ACCEPTABLE
            );
        }
    }
}
