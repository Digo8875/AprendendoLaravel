<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Produto extends Model
{
    protected $table = 'produto';

    protected $fillable = array('ativo','nome');

    protected $guarded = array('id','data_registro');

    public $timestamps = false;

    public static function get_produto($id){

    	if($id == 0)
    	{
	    	$result = DB::table('produto')
	    	        ->join('produto_valor', 'produto.id', '=', 'produto_valor.produto_id')
	    	        ->join('valor', 'produto_valor.valor_id', '=', 'valor.id')
	    	        ->select('produto.*', 'valor.valor')
	    	        ->where('valor.ativo', '=', 1)
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('produto')
	    	        ->join('produto_valor', 'produto.id', '=', 'produto_valor.produto_id')
	    	        ->join('valor', 'produto_valor.valor_id', '=', 'valor.id')
	    	        ->select('produto.*', 'valor.valor')
	    	        ->where('produto.id', '=', $id)
	    	        ->orderBy('produto_valor.id', 'desc')
	    	        ->first();

	    	return $result;
    }

}
