<?php

namespace App\Controller;

use App\Entity\Product;
use App\Services\ProductServices;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SaleProductController extends AbstractController
{

    /**
     * @Entity("Product", expr="repository.find(id)")
     */
    public function __invoke(Product $product, ProductServices $service, Request $request)
    {
        $quantity = $request->query->get('quantity');
        if((int)$quantity == 0){
            $quantity = $request->get('quantity');
            if($quantity > 0){
                $product = $service->sellProduct($product , (int)$quantity);
                return $product;
            }
        }
        $product = $service->sellProduct($product , (int)$quantity);
        return $product;
    }
}
