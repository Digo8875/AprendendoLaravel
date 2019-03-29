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

    public static function get_produto($id)
    {

    	if($id == 0)
    	{
	    	$result = DB::table('produto')
	    	        ->join('produto_valor', 'produto.id', '=', 'produto_valor.produto_id')
	    	        ->join('valor', 'produto_valor.valor_id', '=', 'valor.id')
	    	        ->select('produto.*', 'valor.valor')
	    	        ->where('valor.ativo', '=', 1)
	    	        ->orderBy('produto.id')
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

    public static function get_quant_recebe_produto($id)
    {

    	if($id == 0)
    	{
	    	$result = DB::table('produto')
	    	        ->leftJoin('recebe_produto', 'produto.id', '=', 'recebe_produto.produto_id')
	    	        ->select('produto.id', DB::raw('SUM(recebe_produto.quantidade) as quant_recebe'))
	    	        ->groupBy('produto.id')
	    	        ->orderBy('produto.id')
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('produto')
	    	        ->leftJoin('recebe_produto', 'produto.id', '=', 'recebe_produto.produto_id')
	    	        ->select('produto.id', DB::raw('SUM(recebe_produto.quantidade) as quant_recebe'))
	    	        ->where('produto.id', '=', $id)
	    	        ->groupBy('produto.id')
	    	        ->orderBy('produto.id')
	    	        ->first();

	    	return $result;
    }

    public static function get_quant_venda_produto($id)
    {

    	if($id == 0)
    	{
	    	$result = DB::table('produto')
	    	        ->leftJoin('produto_valor', 'produto.id', '=', 'produto_valor.produto_id')
	    	        ->leftJoin('vende_produto', 'produto_valor.id', '=', 'vende_produto.produto_valor_id')
	    	        ->select('produto.id', DB::raw('SUM(vende_produto.quantidade) as quant_venda'))
	    	        ->groupBy('produto.id')
	    	        ->orderBy('produto.id')
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('produto')
	    	        ->leftJoin('produto_valor', 'produto.id', '=', 'produto_valor.produto_id')
	    	        ->leftJoin('vende_produto', 'produto_valor.id', '=', 'vende_produto.produto_valor_id')
	    	        ->select('produto.id', DB::raw('SUM(vende_produto.quantidade) as quant_venda'))
	    	        ->where('produto.id', '=', $id)
	    	        ->groupBy('produto.id')
	    	        ->orderBy('produto.id')
	    	        ->first();

	    	return $result;
    }

}
