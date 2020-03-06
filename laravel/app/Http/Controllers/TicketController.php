<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TbTicket;
use App\Models\TbUsuario;

class TicketController extends Controller
{
    use ApiResponser;

    public function index(Request $req){
        if($req->id_usuario){
            $usuario = TbUsuario::find($req->id_usuario);
           // return "index";
            if($usuario){
                if($usuario->id_tipo_usuario ==1){
                    $ticket = TbTicket::all();
                }else{
                    //return "ELSE";
                    $ticket = TbTicket::where('id_user','=',$req->id_usuario)->getQuery()->get();
                }
                return $this->successResponse($ticket);
            }else{
                return $this->errorResponse("Problemas con el usuario logeado, favor vuelva a iniciar session",Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }else{
            return $this->errorResponse("Por favor vuelva a iniciar session",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

  /*  public function show(Request $req, $id_ticket){
        return "show ($req->id_usuario)  ticket pedido ($id_ticket)";
        if($req->id_usuario){
            $usuario = TbUsuario::findOrFail($req->id_usuario);
            if($usuario){
                if($usuario->id_tipo_usuario ==1){
                    $ticket = TbTicket::all();
                }else{
                    $ticket = TbTicket::where('id_user','=',$req->id_usuario);
                }
                return $this->successResponse($ticket);
            }else{
                return $this->errorResponse("Problemas con el usuario logeado, favor vuelva a iniciar session",Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }else{
            return $this->errorResponse("Por favor vuelva a iniciar session",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }*/

    public function store(Request $req){
        $id_user = $req->id_user;
        $contenido = $req->contenido;

        if($contenido == ""){
            return $this->errorResponse("falto agregar el contenido", Response::HTTP_NO_CONTENT);
        }
        if($id_user != null && $id_user != 0 && $id_user != '0'){
            $usuario = TbUsuario::find($id_user);
            if(!$usuario){
                return $this->errorResponse("No se encontro el usuario", Response::HTTP_NOT_FOUND);
            }
        }else{
            $id_user =null;
        }
        $ticket = new TbTicket;
        $ticket->id_user=  $id_user ;
        $ticket->contenido=$contenido;
        $ticket->save();
        return $this->successResponse($ticket, Response::HTTP_CREATED);
    }

    public function update($id, Request $req){
        $id_usuario= $req->id_usuario;
        $pedido= $req->ticket_pedido;
        $ticket = TbTicket::find($id);
        $usuario = TbUsuario::find($id_usuario);
        if(! $usuario){
            return $this->errorResponse("Por favor vuelva a iniciar session",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if($ticket){
            if($ticket->id_user == $usuario->id){
                $ticket->ticket_pedido =$pedido;
                $ticket->save();
                return $this->successResponse("Se cambio el estado correctamente",Response::HTTP_ACCEPTED);
            }else{
                return $this->errorResponse("El ticket no pertenece al usuario",Response::HTTP_UNAUTHORIZED);
            }
        }else{
            return $this->errorResponse("No se encontro el ticket seleccionado",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function asignarTicket($id, Request $req){
        $id_usuario= $req->id_usuario;
        $ticket = TbTicket::find($id);
        $usuario = TbUsuario::find($id_usuario);

        if($ticket && $usuario){
            $ticket->id_user= $usuario->id;
            $ticket->save();
            return $this->successResponse("Se asigno correctamente",Response::HTTP_ACCEPTED);
        }if($ticket && $id_usuario ==0){
            $ticket->id_user= null;
            $ticket->save();
            return $this->successResponse("Se asigno correctamente",Response::HTTP_ACCEPTED);
        }

    }

    public function destroy(Request $req){
        $ticket = TbTicket::find($req->id_ticket);

        if($ticket){
            $ticket->delete();
            return $this->successResponse("Se elimino correctamente",Response::HTTP_ACCEPTED);
        }
        return $this->errorResponse("No se encontro el ticket seleccionado",Response::HTTP_UNPROCESSABLE_ENTITY);
    }



}
