<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Venda extends Model
{
    protected $table = 'venda';

    protected $fillable = array('ativo','nome_cliente');

    protected $guarded = array('id','data_registro');

    public $timestamps = false;

    public static function get_venda($id){

    	if($id == 0)
    	{
	    	$result = DB::table('venda')
	    	        ->join('vende_produto', 'venda.id', '=', 'vende_produto.venda_id')
	    	        ->join('produto_valor', 'produto_valor.id', '=', 'vende_produto.produto_valor_id')
	    	        ->join('produto', 'produto.id', '=', 'produto_valor.produto_id')
	    	        ->join('valor', 'valor.id', '=', 'produto_valor.valor_id')
	    	        ->select('venda.*', 'vende_produto.quantidade', 'produto.nome as nome_produto', 'produto.id as produto_id', 'valor.valor')
	    	        ->orderBy('venda.data_registro', 'desc')
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('venda')
	    	        ->join('vende_produto', 'venda.id', '=', 'vende_produto.venda_id')
	    	        ->join('produto_valor', 'produto_valor.id', '=', 'vende_produto.produto_valor_id')
	    	        ->join('produto', 'produto.id', '=', 'produto_valor.produto_id')
	    	        ->join('valor', 'valor.id', '=', 'produto_valor.valor_id')
	    	        ->select('venda.*', 'vende_produto.quantidade', 'produto.nome as nome_produto', 'produto.id as produto_id', 'valor.valor')
	    	        ->where('venda.id', '=', $id)
	    	        ->orderBy('venda.data_registro', 'desc')
	    	        ->first();

	    	return $result;
    }
}
