<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ma_product extends Model
{
    protected $table = 'ma_product';
    protected $primaryKey = 'codpro';
    protected $keyType = 'string';
    public function scopeListaWithDetalle($query)
    {   
        $producto = request()->get('producto');
        $lista = request()->get('lista');
        $tipo_lista = request()->get('tipo_lista');
        $codemp=request()->get('codemp');
        return $query->select([
            'ma_product.codpro',
            'ma_product.despro',
            \DB::raw("estadoproductodimerc(ma_product.CODPRO) 
            as estado, cosprom, costo")
        ])->when(!is_null($producto), function($query) use ($producto){
            $query->whereRaw("ma_product.CODPRO = '{$producto}'");
        })->with('detalleProducto', function($query) use($tipo_lista, $lista, $codemp){
            $query->select(
                'RE_CANPROD.CODPRO',
                \DB::raw("RE_CANPROD.codcnl as lista"),
                \DB::raw("CASE 
                WHEN RE_CANPROD.codcnl BETWEEN 800 and 820 then 'Gobierno'
                WHEN RE_CANPROD.codcnl BETWEEN 900 and 1000 then 'Captura'
                WHEN RE_CANPROD.codcnl BETWEEN 610 and 680 then 'Politica'
                ELSE 'Otras'
                END as tipo_lista"),
                'RE_CANPROD.margen',
                'RE_CANPROD.precio',
                \DB::raw("RE_CANPROD.prefij as precio_minimo"),
                \DB::raw("RE_CANPROD.mgprefijo as mg_minimo")
            )->when(!is_null($tipo_lista), function($query) use ($tipo_lista){
                if ($tipo_lista==='Gobierno') {
                    $query->whereBetween('RE_CANPROD.codcnl',[800,820]);
                }elseif ($tipo_lista==='Captura') {
                    $query->whereBetween('RE_CANPROD.codcnl',[900,1000]);
                }elseif ($tipo_lista==='Politica') {
                    $query->whereBetween('RE_CANPROD.codcnl',[610,680]);
                }
            })->when(!is_null($lista), function ($query) use ($lista){
                $query->whereRaw("RE_CANPROD.codcnl = '{$lista}'");
            })->when(is_null($codemp), function($query) use ($codemp){
                $query->whereRaw("re_canprod.CODEMP = 3");  
            })->when(!is_null($codemp), function($query) use($codemp){
                $query->whereRaw("re_canprod.CODEMP = '{$codemp}'");
            });
            
        });
    }
    public function detalleProducto()
    {
        return $this->hasMany(Re_canprod::class,'codpro', 'codpro');
    }
}