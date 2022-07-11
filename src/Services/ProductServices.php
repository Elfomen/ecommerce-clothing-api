<?php

namespace App\Services;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Doctrine\Persistence\ObjectManager;


class ProductServices {
    public function __construct(private ManagerRegistry $manager)
    {
        
    }

    public function sellProduct(Product $product , int $quatity): Product {
        $manager = $this->manager->getManager();
        // $product->setQuantity($product->getQuantity() - 1);
        $product->setQuantity($product->getQuantity() - $quatity);
        $manager->persist($product);
        $manager->flush();
        return $product;
    }
}