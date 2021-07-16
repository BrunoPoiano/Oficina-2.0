<?php

namespace App\Models\Orcamento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;
    protected $fillable = ['cliente', 'vendedor_id', 'descricao', 'valor'];

}
