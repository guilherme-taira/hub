<?php

namespace App\Jobs;

use App\Models\TrayProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class getShopeeId implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id;
    private $id_shopee;
    public $tries = 3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$id_shopee)
    {
        $this->id = $id;
        $this->id_shopee = $id_shopee;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        TrayProduct::where('referencia', $this->getId())->update(['id_shopee' => $this->getId_shopee()]);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of id_shopee
     */ 
    public function getId_shopee()
    {
        return $this->id_shopee;
    }
}
