<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;

class UserController extends Controller
{

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'identificacion' => 'required',
                'nombre' => 'required',
                'apellidos' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'acreditado' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return $this->responseErrors($e->errors(), 422);
        }
        $user = new User();
        $user->identificacion = $request->identificacion;
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->acreditado = $request->acreditado;
        $user->save();
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201);

    }



    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Datos Incorrectos'], 400);
            }
            else{
                return response()->json(compact('token',200));
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }
}
