<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Producto;
use App\Factura;
use App\DetalleFactura;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{

    public function index()
    {
        $ventas = Venta::where('cancelado', 0)->get();
        return response()->json($ventas, 200);
    }

    public function crearVenta(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            } else {

                $this->validate($request, [
                    'cantidad' => 'required|min:1',
                    'producto_id' => 'required',
                ]);

                $user = JWTAuth::parseToken()->authenticate();
                $producto = Producto::find($request->producto_id);
                $ventaExistente = Venta::where('cancelado', 0)->get();

                if (count($ventaExistente) <= 0) {
                    $subtotal = $producto->precio * $request->input('cantidad');
                    $total = $subtotal;
                    $venta = new Venta();
                    $venta->cantidad = $request->input('cantidad');
                    $venta->cancelado = 0;
                    $venta->precioTotal = $total;

                    $venta->user()->associate($user->id);
                    $venta->producto()->associate($request->input('producto_id'));
                    $venta->save();
                    return response()->json($venta, 201);
                } else {

                    foreach ($ventaExistente as $venta) {
                        if ($venta->cancelado == 0) {

                            if ($venta->producto_id === $producto->id) {
                                $cantidad = $request->cantidad + $venta->cantidad;
                                $subtotal = ($producto->precio * $request->cantidad);
                                $total = $venta->precioTotal + $subtotal;
                                $venta->cantidad = $cantidad;
                                $venta->precioTotal = $total;
                                $venta->save();
                                return response()->json($venta, 201);
                            }
                        }
                    }

                    $subtotal = $producto->precio * $request->input('cantidad');
                    $total = $subtotal;
                    $venta = new Venta();
                    $venta->cantidad = $request->input('cantidad');
                    $venta->cancelado = 0;
                    $venta->precioTotal = $total;

                    $venta->user()->associate($user->id);
                    $venta->producto()->associate($request->input('producto_id'));
                    $venta->save();
                    return response()->json($venta, 201);
                }
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->responseErrors($e->errors(), 422);
        }
    }


    public function terminarVenta(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $ventas = Venta::where('cancelado', 0)->get();
        $fecha = new DateTime();
        $nombreCliente = $request->input('nombreCliente');
        $descuento = $request->input('descuento');
        $total = 0;

        foreach ($ventas as $venta) {
            if ($venta->producto_id === 1 && $venta->cantidad > 1) {
                $producto = Producto::find($venta->producto_id);
                if ($venta->cantidad % 2 == 0) {
                    $mitad = $venta->cantidad / 2;
                    $venta->precioTotal = $mitad * $producto->precio;
                    $venta->save();
                } else {
                    $mitad = ($venta->cantidad / 2) - 1;
                    $venta->precioTotal = ($mitad * $venta->precio) + $venta->precio;
                    $venta->save();
                }
            }

            $total = $total + $venta->precioTotal;
        }

        if (count($ventas) >= 3 && $total >= 10000) {
            $total = $total - ($total * ($descuento / 100));
        }

        $factura = new Factura([
            'nombreCliente' => $nombreCliente,
            'fecha' => $fecha,
            'total' => $total,
            'descuento' => $descuento
        ]);

        $factura->user()->associate($user->id);
        $factura->save();

        $facturas = Factura::where('user_id', $user->id)->get();

        $factura = $facturas->last();

        foreach ($ventas as $venta) {
            if ($venta->cancelado == 0) {
                $detallefactura = new DetalleFactura([
                    'cantidad' => $venta->cantidad,
                    'promo' => 0
                ]);
                $detallefactura->factura()->associate($factura->id);
                $detallefactura->producto()->associate($venta->producto_id);
                $detallefactura->save();
                $venta->cancelado = 1;
                $venta->save();
            }
        }

        return response()->json($factura, 201);
    }
}
