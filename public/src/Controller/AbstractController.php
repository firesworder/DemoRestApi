<?php


namespace App\Controller;

use App\Kernel;
use Doctrine\ORM\EntityManagerInterface;

class AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct()
    {
        $container = Kernel::getContainer();
        $this->entityManager = $container->get('entityManager')->getEntityManager();
    }
}
