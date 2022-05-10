<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brinde extends Model
{

   protected $fillable = [
      'referencia',
      'numeroPromocao',
      'quantidade',
      'datainicial',
      'datafinal',
      'urlImg',
      'Ativo',
  ];

   protected $table = 'brinde';
}
