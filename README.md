Реализованы 3 метода RestAPI:

*Генерация продуктов:*

URL: /product/create-products

Вход: -

Выход: array productsIds 

///

*Создание образа:*

URL: /order/create

Вход: 
- array productIdList список id продуктов для создания заказа

Выход: int orderId 

///

*Генерация продуктов:*

URL: /order/pay

Вход: 
- orderId - id заказа
- paymentAmount - сумма оплаты заказа

Выход: bool status - если успешно оформится - вернет true 
