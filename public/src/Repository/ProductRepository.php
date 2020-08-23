<?php


namespace App\Repository;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    // TODO: убрать по завершению
    public function getEcho()
    {
        echo self::class;
    }

    public function getProductIdList()
    {
        $dql = 'SELECT p.id FROM App\Entity\Product p';

        $query = $this->getEntityManager()->createQuery($dql);
        return array_column($query->getScalarResult(), 'id');
    }
}
