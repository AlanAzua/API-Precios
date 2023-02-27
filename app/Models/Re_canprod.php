<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Re_canprod extends Model
{

    protected $table = 'RE_CANPROD';
    protected $primaryKey ='CODPRO';


    public function encabezado ()
    {
        return $this->belongsTo(Ma_product::class, 'CODPRO');
    }

}
