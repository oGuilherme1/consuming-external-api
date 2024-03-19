<?php

namespace App\Services\Product;

use App\Services\AbstractService;
use App\Repositorys\Product\ProductRepository;

class ProductService extends AbstractService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
        $this->productRepository = $productRepository;
    }

    public function createProductByAPI($data)
    {
        $newData = [];

        $data = json_decode($data, true);

        $result = $this->verifyArray($data);
        
        if($result > 1){
            foreach($data as $products){
                $dadosproducts = [
                    'name' => $products['title'],
                    'price' => $products['price'],
                    'description' => $products['description'],
                    'category' => $products['category'],
                    'image_url' => $products['image'],
                ];

                $newData[] = $dadosproducts;
            }
            return $this->productRepository->createMultipleProductByAPI($newData);
            
        } else {

            $newData = [
                'id' => $data['id'],
                'name' => $data['title'],
                'price' => $data['price'],
                'description' => $data['description'],
                'category' => $data['category'],
                'image_url' => $data['image']
            ];

            return $this->productRepository->createOneProductByAPI($newData);
        }

    }

    private function verifyArray(array $array)
    {
        $result = array_sum(array_map('is_array', $array));
        return $result;
    }

}