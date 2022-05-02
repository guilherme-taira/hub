<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrayProduct extends Model
{
    protected $fillable = [
        'referencia',
        'preco',
        'precosite',
        'PrecoPromocional',
        'QTDBAIXARET',
        'stock',
        'dataInicial',
        'dataFinal',
        'Ativo',
        'desconto'
    ];

    protected $table = 'TrayProdutos';
}
