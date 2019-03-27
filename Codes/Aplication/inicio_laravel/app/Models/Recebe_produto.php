<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recebe_produto extends Model
{
    protected $table = 'recebe_produto';

    protected $fillable = array('quantidade','recebimento_id','produto_id');

    protected $guarded = array('id');

    public $timestamps = false;
}