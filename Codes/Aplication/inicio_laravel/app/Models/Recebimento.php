<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Recebimento extends Model
{
    protected $table = 'recebimento';

    protected $fillable = array('ativo','nome_cliente');

    protected $guarded = array('id','data_registro');

    public $timestamps = false;

    public static function get_recebimento($id){

    	if($id == 0)
    	{
	    	$result = DB::table('recebimento')
	    	        ->join('recebe_produto', 'recebimento.id', '=', 'recebe_produto.recebimento_id')
	    	        ->join('produto', 'produto.id', '=', 'recebe_produto.produto_id')
	    	        ->select('recebimento.*', 'recebe_produto.quantidade', 'produto.nome as nome_produto')
	    	        ->orderBy('recebimento.data_registro', 'desc')
	    	        ->get();

	    	return $result;
    	}

    	$result = DB::table('recebimento')
	    	        ->join('recebe_produto', 'recebimento.id', '=', 'recebe_produto.recebimento_id')
	    	        ->join('produto', 'produto.id', '=', 'recebe_produto.produto_id')
	    	        ->select('recebimento.*', 'recebe_produto.quantidade')
	    	        ->where('recebimento.id', '=', $id)
	    	        ->orderBy('recebimento.data_registro', 'desc')
	    	        ->first();

	    	return $result;
    }
}
