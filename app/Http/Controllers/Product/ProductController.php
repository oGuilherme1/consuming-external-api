<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Services\Product\ProductService;
use App\Http\Controllers\AbstractController;

class ProductController extends AbstractController
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        parent::__construct($productService);
        $this->productService = $productService;
    }

    protected function getFormRequest()
    {
        return app(ProductRequest::class);
    }


    public function store(Request $request)
    {
        $this->validateRequest($request->all());

        $newData = [
            'name' => $request['name'],
            'price' => $request['price'],
            'description' => $request['description'],
            'category' => $request['category'],
            'image_url' => $request['image']
        ];

        return $this->service->store($newData);
    }

    public function update(Request $request, int $id)
    {
        $this->validateRequest($request->all());

        $newData = [
            'name' => $request['name'],
            'price' => $request['price'],
            'description' => $request['description'],
            'category' => $request['category'],
            'image_url' => $request['image']
        ];

        return $this->service->update($newData, $id);
    }

}
