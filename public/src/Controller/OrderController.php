<?php


namespace App\Controller;
use App\Service\Order\OrderCreate;
use App\Service\Order\OrderPay;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class OrderController extends AbstractController
{
    public function createOrder(Request $request)
    {
        try {
            $productIdList = $request->request->get('productIdList');
            if (!$productIdList || !is_array($productIdList)) {
                throw new InvalidArgumentException(
                    'Не передан список(массив) id продуктов.',
                    Response::HTTP_BAD_REQUEST
                );
            }

            $service = new OrderCreate($this->entityManager);
            $result = $service->execute($productIdList);
            return new JsonResponse(['result' => ['orderId' => $result]], Response::HTTP_CREATED);
        } catch (Throwable $exception) {
            return $this->handleException($exception);
        }
    }

    public function payOrder(Request $request)
    {
        try {
            $orderId = intval($request->request->get('orderId'));
            $paymentAmount = floatval($request->request->get('paymentAmount'));
            if (!$orderId) {
                throw new InvalidArgumentException('Не передан id заказа.', Response::HTTP_BAD_REQUEST);
            }
            if (!$paymentAmount || $paymentAmount <= 0) {
                throw new InvalidArgumentException(
                    'Не передана или передана некорректно сумма платежа заказа. Сумма должна быть больше нуля',
                    Response::HTTP_BAD_REQUEST
                );
            }
            $service = new OrderPay($this->entityManager);
            $result = $service->execute($orderId, $paymentAmount);
            return new JsonResponse(['result' => ['status' => $result]], Response::HTTP_ACCEPTED);
        } catch (Throwable $exception) {
            return $this->handleException($exception);
        }
    }
}
