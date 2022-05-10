<?php

namespace App\Jobs;

use App\Http\Controllers\MercadoLivre\UpdateMercadoLivreDadosProduto;
use App\Models\jobs;
use App\Models\TrayProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EnviaProdutoApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($MercadoLivreID, $PrecoPromocional, $preco, $stock, $dataInicial, $dataFinal, $Ativo, $QTDBAIXARET, $precosite, $Peso)
    {
        $this->MercadoLivreID = $MercadoLivreID;
        $this->PrecoPromocional = $PrecoPromocional;
        $this->preco = $preco;
        $this->stock = $stock;
        $this->dataInicial = $dataInicial;
        $this->dataFinal = $dataFinal;
        $this->Ativo = $Ativo;
        $this->QTDBAIXARET = $QTDBAIXARET;
        $this->precosite = $precosite;
        $this->Peso = $Peso;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() 
    {
        $UpdateMercadoLivreDadosProduto = new UpdateMercadoLivreDadosProduto();
        $UpdateMercadoLivreDadosProduto->AtualizaProduto($this->MercadoLivreID, $this->PrecoPromocional, $this->preco, $this->stock, $this->dataInicial, $this->dataFinal, $this->Ativo, $this->QTDBAIXARET, $this->precosite, $this->Peso);

    }
}
