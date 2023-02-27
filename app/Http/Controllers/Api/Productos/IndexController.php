<?php

namespace App\Http\Controllers\Api\Productos;

use App\Http\Controllers\Controller;
use App\Models\Re_canprod;
use App\Models\Ma_product;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Administrador Precios
 **/
class IndexController extends Controller
{
      /**
         * Esta API tiene como finalidad mostrar la información de las listas de precios asignadas a productos especificos, filtrada por 4 campos distintos, los cuales son:
         *  producto, lista, tipo de lista y codigo de empresa. Estos filtros harán que se facilite la visualización y busqueda de estas listas.
         * @queryParam producto string campo para filtrar por el codigo del producto. No-example
         * @queryParam lista int campo para filtrar por numero de lista de precios. No-example
         * @queryParam tipo_lista string campo para filtrar por tipo de lista segun un rango especifico. No-example
         * @queryParam codemp int campo para filtrar por codigo de empresa, su valor por defecto es 3. No-example
         */
    public function __invoke(Request $request)
    {
        
        return new JsonResponse(
            data: $this->ProductoRepository->getAllWithProducto()
        );
    }
    
}
