<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Services\Product\ProductService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class importProductsApiExternalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;

    }
    /**
     * Execute the job.
     */
    public function handle(ProductService $productService): void
    {    
        $productService->createProductByAPI($this->data);
    }
}
