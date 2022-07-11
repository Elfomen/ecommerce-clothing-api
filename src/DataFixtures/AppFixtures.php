<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{   
    private Category $cate;


    public function load(ObjectManager $manager): void
    {
        $categories = $this->getCategories();
        $products = $this->getProducts();
        for ($i=0; $i < count($categories) ; $i++) { 
            $category = new Category();
            $category = $this->prepareCategory($category , $categories[$i]);
            $this->cate = $category;
            $manager->persist($category);
        }

        $cat = $manager->getRepository(Category::class)->findById(1);

        for ($i=0; $i < count($products); $i++) { 
            $product = new Product();

            $product = $this->prepareProduct($product , $products[$i] , $this->cate);

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function prepareProduct(Product $newproduct , $product , $category): Product {
        $newproduct->setName($product["name"]);
        $newproduct->setImageUrl($product["imageUrl"]);
        $newproduct->setQuantity($product["quantity"]);
        $newproduct->setPrice($product["price"]);
        $newproduct->setCategory($category);

        return $newproduct;
    } 

    public function prepareCategory(Category $newcategory ,$category): Category{
        $newcategory->setName($category["title"]);
        $newcategory->setImageUrl($category["imageUrl"]);
        
        return $newcategory;
    }



    public function getProducts () {
        return [
            [
              "id" =>  1,
              "name" =>  "Brown Brim",
              "imageUrl" =>  "https://i.ibb.co/ZYW3VTp/brown-brim.png",
              "price" =>  25 ,
              "quantity" => 15
            ],
            [
              "id" =>  2,
              "name" =>  "Blue Beanie",
              "imageUrl" =>  "https://i.ibb.co/ypkgK0X/blue-beanie.png",
              "price" =>  18 ,
              "quantity" => 15
            ],
            [
              "id" =>  3,
              "name" =>  "Brown Cowboy",
              "imageUrl" =>  "https://i.ibb.co/QdJwgmp/brown-cowboy.png",
              "price" =>  35 ,
              "quantity" => 15
            ],
            [
              "id" =>  4,
              "name" =>  "Grey Brim",
              "imageUrl" =>  "https://i.ibb.co/RjBLWxB/grey-brim.png",
              "price" =>  25 ,
              "quantity" => 15
            ],
            [
              "id" =>  5,
              "name" =>  "Green Beanie",
              "imageUrl" =>  "https://i.ibb.co/YTjW3vF/green-beanie.png",
              "price" =>  18 ,
              "quantity" => 15
            ],
            [
              "id" =>  6,
              "name" =>  "Palm Tree Cap",
              "imageUrl" =>  "https://i.ibb.co/rKBDvJX/palm-tree-cap.png",
              "price" =>  14 ,
              "quantity" => 15
            ],
            [
              "id" =>  7,
              "name" =>  "Red Beanie",
              "imageUrl" =>  "https://i.ibb.co/bLB646Z/red-beanie.png",
              "price" =>  18 ,
              "quantity" => 15
            ],
            [
              "id" =>  8,
              "name" =>  "Wolf Cap",
              "imageUrl" =>  "https://i.ibb.co/1f2nWMM/wolf-cap.png",
              "price" =>  14 ,
              "quantity" => 15
            ],
            [
              "id" =>  9,
              "name" =>  "Blue Snapback",
              "imageUrl" =>  "https://i.ibb.co/X2VJP2W/blue-snapback.png",
              "price" =>  16 ,
              "quantity" => 15
            ]
            ];
          
    }


    public function getCategories() {
        return [
            [
              "title" =>  "hats",
              "imageUrl" =>  "https://i.ibb.co/cvpntL1/hats.png"
            ],
            [
              "title" =>  "jackets",
              "imageUrl" =>  "https://i.ibb.co/px2tCc3/jackets.png"
            ],
            [
              "title" =>  "sneakers",
              "imageUrl" =>  "https://i.ibb.co/0jqHpnp/sneakers.png"
            ],
            [
              "title" =>  "womens",
              "imageUrl" =>  "https://i.ibb.co/GCCdy8t/womens.png"
            ],
            [
              "title" =>  "mens",
              "imageUrl" =>  "https://i.ibb.co/R70vBrQ/men.png"
            ]
            ];
    }
}
