<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class ContentController
{
    /**
     * Метод контроллера для вывода "контента" главной страницы
     * @return Response
     */
    public function showMainPage()
    {
        return new Response('Главная страница');
    }
}
