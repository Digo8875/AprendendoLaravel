<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'venda';

    protected $fillable = array('ativo','nome_cliente');

    protected $guarded = array('id','data_registro');

    public $timestamps = false;
}
