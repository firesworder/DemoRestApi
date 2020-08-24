<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity (repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table (name="orders")
 */
class Order
{
    public const ORDER_PAYED_STATUS = 'Payed';
    public const ORDER_NEW_STATUS = 'New';

    /**
     * @ORM\Id
     * @ORM\Column (type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToMany  (targetEntity="Product")
     * @var ArrayCollection
     */
    private $products;

    /**
     * @ORM\Column (type="string")
     * @var string
     */
    private $status;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
        return $this;
    }
}
