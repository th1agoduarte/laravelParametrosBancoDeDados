<?php

namespace App\Traits;

use App\Models\Apilogs;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait ApiResponser
{
	/**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected Request $request;
	protected function success($data, string $message = null, int $code = 200): JsonResponse
	{
        /* try{
            Apilogs::create([
                'origin_address' => $this->request->ip(),
                'destination_address' => $this->request->url(),
                'payload' => json_encode($this->request->all()),
                'message' => $message,
                'code' => $code,
                'data' => json_encode($data),
            ]);
        }catch(\Exception $e){
            Apilogs::create([
                'data' => json_encode($e->getMessage()),
            ]);
        } */

		return response()->json([
			'status' => 'Success',
			'message' => $message,
			'data' => $data
		], $code);
	}

	/**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
	protected function error(string $message = null, int $code, $data = null): JsonResponse
	{
        /* try{
            Apilogs::create([
                'origin_address' => $this->request->ip(),
                'destination_address' => $this->request->url(),
                'payload' => json_encode($this->request->all()),
                'message' => $message,
                'code' => $code,
                'data' => json_encode($data),
            ]);
        }catch(\Exception $e){
            Apilogs::create([
                'data' => json_encode($e->getMessage()),
            ]);
        } */
		return response()->json([
			'status' => 'Error',
			'message' => $message,
			'data' => $data
		], $code);
	}

}
