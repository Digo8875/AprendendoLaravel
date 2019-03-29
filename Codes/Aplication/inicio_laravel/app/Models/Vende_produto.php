<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Vende_produto extends Model
{
    protected $table = 'vende_produto';

    protected $fillable = array('quantidade','venda_id','produto_id');

    protected $guarded = array('id');

    public $timestamps = false;

    public static function get_vende_produto_por_venda($venda_id){

    	$result = DB::table('vende_produto')
    	        ->join('venda', 'venda.id', '=', 'vende_produto.venda_id')
    	        ->select('vende_produto.*')
    	        ->where('vende_produto.id', '=', $venda_id)
    	        ->first();

    	return $result;
    }
}