<?php

namespace App\Jobs;

use App\Http\Controllers\Shopee\UpdateProductController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPutProductsShopee implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $partner_id;
    private $timestamp;
    private $access_token;
    private $id_product;
    private $price;
  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $partner_id, string $timestamp,string $access_token,int $id_product,float $price)
    {
        $this->partner_id = $partner_id;
        $this->timestamp = $timestamp;
        $this->access_token = $access_token;
        $this->id_product = $id_product;
        $this->price = $price;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $putProduct = new UpdateProductController($this->getPartner_id(),$this->getTimestamp(),$this->getAccess_token(),$this->getId_product(),$this->getPrice());
        $putProduct->execute();
    }

    /**
     * Get the value of partner_id
     */ 
    public function getPartner_id()
    {
        return $this->partner_id;
    }

    /**
     * Get the value of timestamp
     */ 
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the value of access_token
     */ 
    public function getAccess_token()
    {
        return $this->access_token;
    }

    /**
     * Get the value of id_product
     */ 
    public function getId_product()
    {
        return $this->id_product;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }
}
