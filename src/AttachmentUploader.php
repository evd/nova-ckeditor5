<?php
declare(strict_types=1);

namespace Realevd\NovaCkeditor5;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class AttachmentUploader
{
    /**
     * Storage Disk
     *
     * @var string
     */
    private string $disk;

    /**
     * Storage Path
     *
     * @var string
     */
    private string $path;

    /**
     * ImageStorage constructor
     *
     * @param string $disk
     */

    public function __construct(string $disk = 'public', string $path = 'attachments')
    {
        $this->disk = $disk;
        $this->path = $path;
    }

    /**
     * Handle the File Upload
     *
     * @param UploadedFile $file
     * @return string
     * @throws \Throwable
     */
    public function store(UploadedFile $file): string
    {
        $image = Image::load($file->getRealPath());
        $this->processImage($image);
        $image->save();

        $filename = $this->getFilename($file);

        return Storage::url($file->storePubliclyAs($this->path, $filename, [
            'disk' => $this->disk
        ]));
    }

    public function getFilename(UploadedFile $file)
    {
        return md5_file($file->getRealPath()) . '.' . $file->getClientOriginalExtension();
    }

    public function processImage(Image $image)
    {
        $maxWidth = config('nova-ckeditor5.image_process.max_width', 1024);
        $maxHeight = config('nova-ckeditor5.image_process.max_height', 768);

        if ($maxWidth && $maxHeight) {
            $image->fit(Manipulations::FIT_MAX, $maxWidth, $maxHeight);
        }
    }
}
