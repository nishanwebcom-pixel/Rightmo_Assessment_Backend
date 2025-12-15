<?php
namespace App\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Str;

trait FileUploadTrait
{
    public function fileUpload($base64String, $generateTempLink, $description = null)
    {
        try {
            $fileMeta = $this->getFileMetaData($base64String);
            if (Str::contains($base64String, ',')) {
                [, $base64String] = explode(',', $base64String);
            }
            if (!$fileMeta['extension']) {
                abort(500, 'File are not allowed to upload');
            }
            $decodedFile = base64_decode($base64String);
            if ($decodedFile === false) {
                abort(500, 'File base64 format is invalid');
            }
            if ($decodedFile === false) {
                abort(500, 'File base64 format is invalid');
            }
            $uniqueFilename = uniqid() . '.' . $fileMeta['extension'];
            $fullPath = 'uploads/' . $uniqueFilename;
            Storage::disk('public')->put($fullPath, $decodedFile);
            if ($generateTempLink) {
                $temporaryUrl = $this->generateTemplink($uniqueFilename);
                return [
                    'path' => $fullPath,
                    'url' => $temporaryUrl
                ];

            } else {
                return [
                    'path' => $uniqueFilename
                ];
            }
            // Storage::disk('s3')->put($fullPath, $decodedFile);
            // if ($generateTempLink) {
            //     return [
            //         'path' => $fullPath,
            //         'url' => $this->generateS3TemporaryUrl($fullPath)
            //     ];
            // } else {
            //     return [
            //         'path' => $fullPath
            //     ];
            // }
        } catch (Exception $e) {
            abort(500, $e->getMessage());
        }
    }


    public function getFileMetaData(string $base64String)
    {
        if (Str::contains($base64String, ';base64')) {
            preg_match("/^data:(.*?);base64/", $base64String, $matches);
            if (isset($matches[1])) {
                $mimeType = $matches[1];
                $extension = null;
                if (isset($mimeType)) {
                    $mimeToExtensionMap = [
                        'image/jpeg' => 'jpg',
                        'image/pjpeg' => 'jpg',
                        'image/png' => 'png',
                        'image/webp' => 'webp'
                    ];
                    $extension = $mimeToExtensionMap[$mimeType] ?? explode('/', $mimeType)[1] ?? null;
                }
                return [
                    'mime' => $mimeType,
                    'extension' => $extension,
                ];
            }
        }
        return null;
    }

    public function generateS3TemporaryUrl(string $path, int $minutes = 5): ?string
    {
        if (!Storage::disk('s3')->exists($path)) {
            return null;
        }
        return Storage::disk('s3')->temporaryUrl(
            $path,
            Carbon::now()->addMinutes($minutes)
        );
    }

    public function generateTemplink($uniqueFilename)
    {
        return URL::temporarySignedRoute(
            'temporary.file',
            now()->addHour(),
            ['filename' => $uniqueFilename]
        );
    }

    public function deleteFile($fileName)
    {
        try {
            if ($fileName != 'dummy_product.jpg') {
                $fullPath = 'uploads/' . $fileName;
                Storage::disk('public')->delete($fullPath);
            }
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }
}
