<?php

namespace App\Console\Commands;

use App\Jobs\importProductsApiExternalJob;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class importProductsApiExterna extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from an external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $productId = $this->option('id');

        $client = new Client();

        try {

            if ($productId) {
                $response = $client->get('https://fakestoreapi.com/products/' . $productId);
            } else {
                $response = $client->get('https://fakestoreapi.com/products');
            }
            
            $statusCode = $response->getStatusCode();
            
            if ($statusCode === 200) {
                $bodyContentents = $response->getBody()->getContents();
                
                importProductsApiExternalJob::dispatch($bodyContentents);

                $this->info('Products imported successfully!');
            } else {
                $this->error('Failed to import products from the external API. Status code: ' . $statusCode);
            }
        } catch (\Exception $e) {
            $this->error('Failed to import products from the external API. Error: ' . $e->getMessage());
        }
    }
}
