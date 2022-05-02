<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'descricao',
        'gtin',
        'preco_venda',
        'preco_promocao',
        'sku',
        'ativo',
        'estoque',
        'categoria',
        'envia_ecommerce',
    ];

    protected $table = 'product';
}
