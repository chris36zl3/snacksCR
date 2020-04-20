<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;

class ProductoController extends Controller
{
    public function registrarProducto(Request $request)
    {
        try {
            $this->validate($request, [
                'codigo' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
                'precio' => 'required',
                'cantidad' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return $this->responseErrors($e->errors(), 422);
        }
        $producto = new Producto();
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->save();
        return response()->json($producto, 201);

    }

    public function index()
    {
        try {

            $productos=Producto::orderBy('nombre', 'desc')->get();
            $response=[
                'msg'=>'Lista de Productos',
                'Productos'=>$productos
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(),422);
        }

    }
}
