<?php

namespace Realevd\NovaCkeditor5\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;
use Realevd\NovaCkeditor5\AttachmentUploader;

class UploadController extends Controller
{
    /**
     * Store an attachment
     *
     * @param NovaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NovaRequest $request)
    {
        $uploaderClass = config('nova-ckeditor5.attachment_uploader');
        /** @var AttachmentUploader $uploader */
        $uploader = new $uploaderClass();

        return response()->json([
            'uploaded' => true,
            'url' => $uploader->store($request->file('attachment'))
        ]);
    }
}
