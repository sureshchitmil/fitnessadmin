<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\FileUploadAPIRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class FileUploadController extends AppBaseController
{
    /**
     * @param FileUploadAPIRequest $request
     *
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     *
     * @return JsonResponse
     */
    public function upload(FileUploadAPIRequest $request): JsonResponse
    {
        $files = $request->file('files');
        foreach ($files as $file) {
            $user = User::first();
            $user->addMedia($file)->toMediaCollection('default', config('app.media_disc'));
        }

        return $this->successResponse('File upload successfully.');
    }
}
