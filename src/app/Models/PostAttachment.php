<?php

namespace Arealtime\Post\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostAttachment extends Model
{
    protected  $fillable = ['path', 'original_name', 'mime_type', 'size', 'extension'];


    public function base64Attachment(): Attribute
    {
        return Attribute::make(
            get: function () {
                $fileContents = Storage::disk('public')->get($this->path);
                $mimeType = Storage::mimeType($this->path);

                $base64 = base64_encode($fileContents);
                return "data:$mimeType;base64,$base64";
            }
        );
    }
}
