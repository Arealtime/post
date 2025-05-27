<?php

namespace Arealtime\Post\App\Services;

use Arealtime\FileUploader\App\Services\FileUploaderService;
use Throwable;

trait PostAttachmentAction
{
    public function createAttachment(array $attachments)
    {
        $this->checkPostSet();
        $folder = 'posts/' . $this->post->id;

        $fileUploaderService = new FileUploaderService();

        foreach ($attachments as $attachment) {
            $file = $fileUploaderService->setFolder($folder)->upload($attachment);
            $this->post->attachments()->create([
                'path' => $file->path,
                'original_name' => $file->original_name,
                'mime_type' => $file->mime_type,
                'size' => $file->size,
                'extension' => $file->extension
            ]);
        }
    }

    /**
     * Delete all comments made by the current authenticated user for the current post.
     *
     * @return int Number of deleted comments
     *
     * @throws Throwable If a database error occurs
     */
    public function deleteAttachment(): void
    {
        $this->checkPostSet();

        $this->post->attachments()->delete();
    }
}
