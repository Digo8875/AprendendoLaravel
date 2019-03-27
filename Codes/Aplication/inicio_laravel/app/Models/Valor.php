<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Valor extends Model
{
    protected $table = 'valor';

    protected $fillable = array('ativo','valor','produto_id');

    protected $guarded = array('id','data_registro');

    public $timestamps = false;


    public static function get_valor_por_produto($prod_id){

    	$result = DB::table('valor')
    	        ->join('produto_valor', 'produto_valor.valor_id', '=', 'valor.id')
    	        ->join('produto', 'produto.id', '=', 'produto_valor.produto_id')
    	        ->select('valor.*')
    	        ->where('produto.id', '=', $prod_id)
    	        ->where('valor.ativo', '=', 1)
    	        ->first();

    	return $result;
    }

}
