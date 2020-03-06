<?php
namespace App\Traits;
use Illuminate\Http\Response;

trait ApiResponser{

    /**
    * Build a success response
    * @param string o array $data
    * @param int $code
    * @return Iliminate\Http\JsonResponse
    */
    public function successResponse($data, $code = Response::HTTP_OK){
        return response()->json(['data'=>$data],$code);
    }
    /**
    * Build  error response
    * @param string o array $data
    * @param int $code
    * @return Iliminate\Http\JsonResponse
    */
    public function errorResponse($mensaje, $code){
        return response()->json(['error'=>$mensaje, 'code'=>$code], $code);
    }

}
?>
