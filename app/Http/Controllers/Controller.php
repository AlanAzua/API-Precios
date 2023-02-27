<?php

namespace App\Http\Controllers;

use App\Productos\EloquentProductoRepository;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct(protected EloquentProductoRepository $ProductoRepository){}
}
