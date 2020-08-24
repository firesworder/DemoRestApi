Реализованы 3 метода RestAPI:

*Генерация продуктов:*

URL: /product/create-products

Тип запроса: POST

Вход: -

Выход: array productsIds 

///

*Создание образа:*

URL: /order/create

Тип запроса: POST

Вход: 
- array productIdList список id продуктов для создания заказа

Выход: int orderId 

///

*Генерация продуктов:*

URL: /order/pay

Тип запроса: PUT

Вход: 
- orderId - id заказа
- paymentAmount - сумма оплаты заказа

Выход: bool status - если успешно оформится - вернет true 
