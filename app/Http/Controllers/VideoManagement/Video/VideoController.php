<?php

namespace App\Http\Controllers\VideoManagement\Video;


use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Domains\VideoManagement\Video\Services\VideoFileService;
use App\Domains\VideoManagement\Video\Services\VideoService;
use App\Events\VideoManagement\Video\VideoUploadCompleted;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\VideoManagement\Video\StoreVideoRequest;
use App\Http\Requests\VideoManagement\Video\UpdateVideoRequest;
use App\Http\Requests\VideoManagement\Video\UploadVideoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class VideoController extends AbstractController
{
    public function __construct(VideoService $service, protected VideoFileService $videoFileService)
    {
        $this->requestValidate = StoreVideoRequest::class;
        $this->requestValidateUpdate = UpdateVideoRequest::class;
        $this->service = $service;
    }

    public function upload(VideoEntity $video, Request $request): JsonResponse
    {
        try {
            $requestValidate = app(UploadVideoRequest::class);
            $request->validate($requestValidate->rules());
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }

        try {
            DB::beginTransaction();
            $file = $request->file('file');
            $path = $file->store('uploads', 'videos');

            $videoFileEntity = $this->videoFileService->save([
                'video_id' => $video->id,
                'file_name' => $file->hashName(),
                'file_original_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_format' => $file->getMimeType(),
                'file_path' => $path,
                'file_extension' => $file->getClientOriginalExtension()
            ]);
            DB::commit();

            event(new VideoUploadCompleted($video, $videoFileEntity));

            return $this->success($this->messageSuccessDefault, ['response' => $videoFileEntity]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->error($exception->getMessage());
        }
    }
}
