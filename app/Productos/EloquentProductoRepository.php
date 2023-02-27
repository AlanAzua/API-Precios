<?php

namespace App\Productos;

use App\Productos\Interfaces\ProductoRepository;
use App\Models\Re_canprod;
use App\Models\MA_product;
use App\Resources\CreditoSapResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentProductoRepository implements ProductoRepository
{
    /**
     * @param Ma_product $producto
     */
    public function __construct(
        protected Ma_product $producto
    ){}

    public function findProductos(): object
    {
        return QueryBuilder::for($this->producto)
        ->firstOrFail();
    }
    /**
     *
     * @return LengthAwarePaginator
     */
    function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(
            subject: $this->producto
        )->fastPaginate();
    }

     /**
     *
     * @return LengthAwarePaginator
     */
    function getAllWithProducto(): LengthAwarePaginator
    {
        return QueryBuilder::for(
            subject: $this->producto
        )->listaWithDetalle()
        ->fastPaginate();
    }
}
