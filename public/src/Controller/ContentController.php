<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class ContentController
{
    public function showMainPage()
    {
        return new Response('Главная страница');
    }
}
