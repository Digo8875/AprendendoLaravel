<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Produto_valor extends Model
{
    protected $table = 'produto_valor';

    protected $fillable = array('produto_id','valor_id');

    protected $guarded = array('id');

    public $timestamps = false;


    public static function get_produto_valor_atual($produto_id){

    	$result = DB::table('produto_valor')
    	        ->join('produto', 'produto.id', '=', 'produto_valor.produto_id')
    	        ->select('produto_valor.*')
    	        ->where('produto.id', '=', $produto_id)
    	        ->orderBy('produto_valor.id', 'desc')
    	        ->first();

    	return $result;
    }
}