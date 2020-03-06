<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Auth;
use App\Models\TbUsuario;
use App\Traits\ApiResponser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    use ApiResponser;

    public function username(){
        return 'mail';
    }

    public function password()
    {
        return 'pass';
    }

    public function login(){
        return $this->errorResponse("UnAuthorised",Response::HTTP_UNAUTHORIZED);
    }

    public function logear(Request $req){
        $usuario = TbUsuario::Where('id_tipo_usuario','=',1)->where('fecha_eliminacion','=',NULL)->getquery()->get();
        if(count($usuario)==0){
            $nuevo = New TbUsuario();
            $nuevo->id_tipo_usuario = 1;
            $nuevo->nombre = "admin";
            $nuevo->mail = "admin@admin.com";
            $nuevo->pass = "123admin";
            $nuevo->save();
        }

            $user = TbUsuario::where('mail', $req->mail)->first();
            if(!$user){
                // se comenta ya que especifico que el usuario no existe y no es bueno dar a conocer que el usuario no esta registrado
               // return $this->errorResponse("No se encontro el usuario",Response::HTTP_UNPROCESSABLE_ENTITY);
               return $this->errorResponse("Clave o nombre de usuario incorrecta",Response::HTTP_UNAUTHORIZED);
            }

            if(Hash::check($req->pass, $user->pass)){

            $apikey =  $user->createToken('Laravel')->accessToken;
           // $user->getAllPermissions();
           // $apikey = [];
                $respuesta = ["token"=>$apikey, "user"=>$user ];
                return $this->successResponse($respuesta,Response::HTTP_OK);
            }else{
                return $this->errorResponse("Clave o nombre de usuario incorrecta",Response::HTTP_UNAUTHORIZED);
            }
     }

    public function logout(Request $req){
        $req->session()->flush();
        Auth::logout();
        dd("fuera");
        return redirect('/login');
    }


    public function store(Request $data){
        $reglas=[
            'tipo_usuario'=>'required',
            'nombre'=>'required|min:5|max:100',
            'mail'=>'required|max:200|unique:tb_usuarios',
            'pass'=>'required|min:6|max:240',
            'pass2'=>'required|min:6|max:240|same:pass',
        ];
       // $this->validate($data,$reglas);

        $nuevo = New TbUsuario();
        $nuevo->id_tipo_usuario = $data->tipo_usuario;
        $nuevo->nombre = $data->nombre;
        $nuevo->mail = $data->mail;
        $nuevo->pass = $data->pass;
        $nuevo->save();
        return $this->successResponse($nuevo, Response::HTTP_CREATED);
    }
    public function index(Request $req){
        $usu = TbUsuario::where('id_tipo_usuario','=','2')->getQuery()->get();
        return $this->successResponse($usu);
    }

}
