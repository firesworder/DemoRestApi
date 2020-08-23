<?php


namespace App\Controller;

use App\AppContainer;
use Doctrine\ORM\EntityManagerInterface;

class AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct()
    {
        $this->entityManager = AppContainer::getEntityManager();
    }
}
