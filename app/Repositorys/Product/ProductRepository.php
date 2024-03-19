<?php

namespace App\Repositorys\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Repositorys\AbstractRepository;
use Illuminate\Database\QueryException;


class ProductRepository extends AbstractRepository
{
    protected $productModel;

    public function __construct(Product $productModel)
    {
        parent::__construct($productModel);
        $this->productModel = $productModel;
    }

    public function createOneProductByAPI($data)
    {
        try {
            $this->productModel::create($data);
        } catch (QueryException $e) {
            Log::error("Error ao criar o produto: " . $e->getMessage());
        }
    }

    public function createMultipleProductByAPI($data)
    {
        try {
            foreach ($data as $products) {
                $productNameExist = $this->productModel::where("name", $products["name"])->first();

                if($productNameExist) continue;
                
                $this->productModel::create($products);
            }
        } catch (QueryException $e) {
            Log::error("Error ao criar o produto: " . $e->getMessage());
        }
    }
}
