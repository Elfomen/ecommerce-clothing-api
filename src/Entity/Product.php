<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ProductController;
use App\Controller\SaleProductController;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:Product:collection' , 'read:Category:collection']],
    itemOperations: [
        'get',
        'sale' => [
            'denormalization_context' => ['groups' => ['write:Product:sale']] ,
            'path' => 'product/{id}/sale/{quantity}',
            'method' => 'post',
            'controller' => SaleProductController::class,
            'openapi_context' => [
                'summary' => 'This permit you to reduce the quantity of a product in stock when there is a sale',
                'parameters' => [
                    [
                        'in' => 'query',
                        'name' => 'quantity',
                        'description' => 'Quantity of the soled product',
                        'required' =>  true ,
                        'schema' => [
                            'type' => 'integer',
                            'default' => 0
                        ]
                    ],
                ],
                // 'responses' => [
                //     '202' => [
                //         'description' => 'Success',
                //         'content' => [
                //             'application/json' => [
                //                 'schema' => [
                //                     'type' => 'integer',
                //                     'example' => 3
                //                 ]
                //             ]
                //         ]
                //     ]
                // ]

            ] , 
            
        ] , 
        'patch'
    ]
)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:Product:collection' , 'read:Category:collection'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:Product:collection' , 'read:Category:collection'])]
    private $imageUrl;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:Product:collection' , 'read:Category:collection'])]
    private $name;

    #[ORM\Column(type: 'integer')]
    #[Groups(['read:Product:collection' , 'read:Category:collection'])]
    private $quantity;

    #[ORM\Column(type: 'float')]
    #[Groups(['read:Product:collection' , 'read:Category:collection'])]
    private $price;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
