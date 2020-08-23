<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
    // TODO: убрать по завершению
    public function getEcho()
    {
        echo self::class;
    }
}
