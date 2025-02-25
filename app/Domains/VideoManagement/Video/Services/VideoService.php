<?php

namespace App\Domains\VideoManagement\Video\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Domains\VideoManagement\Video\Entities\VideoFileEntity;
use App\Domains\VideoManagement\Video\Repositories\VideoRepository;
use App\Events\VideoManagement\Video\VideoCreated;
use App\Events\VideoManagement\Video\VideoPublished;
use App\Events\VideoManagement\Video\VideoUploadCompleted;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class VideoService extends AbstractService
{
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
         event(new VideoCreated($entity, $params));

        return $entity;
    }

    public function uploadVideo(array $params): VideoFileEntity
    {
        /** @var VideoEntity $videoEntity */
        $videoEntity = $this->find(data_get($params, 'video_id'));
        /** @var File $file */
        $file = data_get($params, 'video');

        $path = Storage::putFile('videos', $file);

        $params['file_name'] = $file->hashName();
        $params['file_original_name'] = $file->getFileInfo()->getFilename();
        $params['file_path'] = $path;
        $params['file_size'] = $file->getSize();
        $params['file_format'] = $file->getMimeType();
        $params['file_extension'] = $file->getExtension();

       $videoFileEntity = $this->repository->saveVideoFile($videoEntity, $params);

       event(new VideoUploadCompleted($videoEntity, $videoFileEntity));

       return $videoFileEntity;
    }

    public function beforeUpdate($id, array $data): array
    {
        $entity = $this->find($id);

        if (!!$entity?->is_published && !!data_get($data, 'is_published')) {
            unset($data['is_published']);
        }

        return $data;
    }

    public function afterUpdate($entity, array $params): void
    {
        if (!!$entity->is_published && data_get($params, 'is_published') === true) {
            event(new VideoPublished($entity));
        }
    }
}
