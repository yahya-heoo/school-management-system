<?php

namespace App\Traits;

use App\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



trait HandlingAttachmentsTrait
{


    protected function getDisk()
    {
        return 'upload_attachments';
    }



    protected function getDirectory($model): string
    {
        $modelName = Str::plural(Str::snake(class_basename($model)));
        return "attachments/{$modelName}/{$model->id}";
    }



    protected function generateSafeFileName(string $originalName): string
    {
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $slug = Str::slug($name);

        return $slug . '_' . time() . '_' . Str::random(6) . '.' . $extension;
    }



    protected function storeAttachment(UploadedFile $file, $model, $directory)
    {

        $originalName = $file->getClientOriginalName();
        $fileName = $this->generateSafeFileName($originalName);


        // Store file
        $filePath = $file->storeAs($directory, $fileName, $this->getDisk());

        return Attachment::create([
            'file_name' => $originalName,
            'attachmentable_id' => $model->id,
            'attachmentable_type' => get_class($model),
            'storage_path' => $filePath,

        ]);
    }



    public function uploadAttachments($files, $model, $directory): array //array of attachments [attachment] or [attachment1, attachmet2,...]
    {
        $uploaded = [];

        // handle both single and mulitple file uploading
        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {

            //some cases files are not valid , so check the validaty even in massy upload
            if ($file instanceof UploadedFile && $file->isValid()) {
                $uploaded[] = $this->storeAttachment($file, $model, $directory);
            }
        }

        return $uploaded;
    }

    public function downloadAttachment(Attachment $attachment)
    {
        $filePath = $attachment->storage_path;
        $disk = Storage::disk($this->getDisk());

        if (!$disk->exists($filePath)) {
            throw new \Exception("File not found: {$filePath}");
        }

        return response()->download($filePath, $attachment->file_name);
    }


    public function deleteAttachment(Attachment $attachment): bool
    {
        try {
            // Delete physical file
            Storage::disk($this->getDisk())->delete($attachment->storage_path);

            // Delete database record
            return $attachment->delete();
        } catch (\Exception $e) {
            logger()->error("Failed to delete attachment: {$e->getMessage()}");
            return false;
        }
    }

    protected function cleanupEmptyFolder($model)
    {
        $directory = $this->getDirectory($model);
        $files = Storage::disk($this->getDisk())->files($directory);

        if (empty($files)) {
            Storage::disk($this->getDisk())->deleteDirectory($directory);
        }
    }

    public function deleteModelAttachments($model)
    {
        $attachments = Attachment::where([
            'attachmentable_id' => $model->id,
            'attachmentable_type' => get_class($model)
        ])->get();

        foreach ($attachments as $attachment) {
            $this->deleteAttachment($attachment);
        }

        // Delete the entire folder if empty
        $this->cleanupEmptyFolder($model);
    }
}