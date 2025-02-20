<?php


namespace App\Http\Controllers;

use App\Domains\Abstracts\ServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

abstract class AbstractController extends Controller
{
	protected ServiceInterface $service;
	protected $requestValidate;
	protected $requestValidateUpdate;

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
        $with = $request->get('with', []);
        $params = $request->get('params', []);

		$items = $this->service
			->getAll($params, $with)
			->toArray();

		return $this->ok($items);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function store(Request $request): JsonResponse
	{
		try {
			if ($this->requestValidate) {
				$requestValidate = app($this->requestValidate);
				$request->validate($requestValidate->rules());
			}
		} catch (ValidationException $e) {
			return $this->error($this->messageErrorDefault, $e->errors());
		}

		try {
			DB::beginTransaction();
			$response = $this->service->save($request->all());
			DB::commit();
			return $this->success($this->messageSuccessDefault, ['response' => $response]);
		} catch (\Exception | ValidationException $e) {
			DB::rollBack();
			if ($e instanceof ValidationException) {
				return $this->error($this->messageErrorDefault, $e->errors());
			}
			if ($e instanceof \Exception) {
				return $this->error($e->getMessage());
			}
		}
	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, $id)
	{
		try {
			if (!empty($this->requestValidateUpdate)) {
				$requestValidateUpdate = app($this->requestValidateUpdate);
				$request->validate($requestValidateUpdate->rules());
			}
		} catch (ValidationException $e) {
			return $this->error($this->messageErrorDefault, $e->errors());
		}

		try {
			DB::beginTransaction();
			$this->service->update($id, $request->all());
			DB::commit();
			return $this->success($this->messageSuccessDefault);
		} catch (\Exception | ValidationException $e) {
			DB::rollBack();
			if ($e instanceof \Exception) {
				return $this->error($e->getMessage());
			}
			if ($e instanceof ValidationException) {
				return $this->error($this->messageErrorDefault, $e->errors());
			}
		}
	}

	/**
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id, Request $request): JsonResponse
	{
		try {
            $with = $request->get('with', []);

			return $this->ok($this->service->find($id, $with)->toArray());
		} catch (\Exception | ValidationException $e) {
			DB::rollBack();
			if ($e instanceof \Exception) {
				return $this->error($e->getMessage());
			}
			if ($e instanceof ValidationException) {
				return $this->error($this->messageErrorDefault, $e->errors());
			}
		}
	}


	/**
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id)
	{
		try {
			$this->service->delete($id);
			return $this->success($this->messageSuccessDefault);
		} catch (\Exception $e) {
			return $this->error($e->getMessage());
		}
	}

	/**
	 * @param null $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function preRequisite($id = null)
	{
		$preRequisite = $this->service->preRequisite($id);
		return $this->ok(compact('preRequisite'));
	}


	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function toSelect()
	{
		return $this->ok($this->service->toSelect());
	}
}
