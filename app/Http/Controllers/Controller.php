<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     protected $messageSuccessDefault = 'Operação realizada com com sucesso';
	 protected $messageErrorDefault = 'Ops';
	 const TYPE_SUCCESS = 'success';
	 const TYPE_ERROR = 'error';

	 /**
	  * @param array $items
	  * @param int $status
	  * @return JsonResponse
	  */
	 public function ok(array $items = [], int $status = Response::HTTP_OK): JsonResponse
	 {
	 	$data = [
	 		'type' => self::TYPE_SUCCESS,
	 		'status' => $status,
	 		'data' => $items,
	 		'show' => false
	 	];

	 	return response()->json($data, $status);
	 }

	 /**
	  * @param string $message
	  * @param array $items
	  * @param int $status
	  * @return JsonResponse
	  */
	 public function error(
	 	string $message = '',
	 	array $items = [],
	 	int $status = Response::HTTP_UNPROCESSABLE_ENTITY
	 ): JsonResponse
	 {
	 	if (is_null($message)) {
	 		$message = $this->messageErrorDefault;
	 	}

	 	$data = [
	 		'type' => self::TYPE_ERROR,
	 		'status' => $status,
	 		'message' => $message,
	 		'show' => true
	 	];

	 	if ($items) {
	 		foreach ($items as $key => $item) {
	 			$data['errors'][$key] = $item;
	 		}
	 	}

	 	return response()->json($data, $status);
	 }

	 /**
	  * @param string $message
	  * @param array $items
	  * @param int $status
	  * @return JsonResponse
	  */
	 public function success(
	 	string $message,
	 	array $items = [],
	 	int $status = Response::HTTP_OK
	 ): JsonResponse
	 {
	 	if (!$message) {
	 		$message = $this->messageSuccessDefault;
	 	}

	 	$data = [
	 		'type' => self::TYPE_SUCCESS,
	 		'status' => $status,
	 		'message' => $message,
	 		'show' => true
	 	];

	 	if ($items instanceof Arrayable) {
	 		$items = $items->toArray();
	 	}

	 	if ($items) {
	 		foreach ($items as $key => $item) {
	 			$data[$key] = $item;
	 		}
	 	}

	 	return response()->json($data, $status);
	 }
}
