<?php

namespace App\Productos\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface ProductoRepository
{
    /**
     * @return LengthAwarePaginator
     */
    function getAll(): LengthAwarePaginator;

 /**
     * @return LengthAwarePaginator
     */
    function getAllWithProducto();

}
