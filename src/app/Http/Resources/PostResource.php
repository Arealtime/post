<?php

namespace Arealtime\Post\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'caption' => $this->caption,
            'type' => $this->type,
            'location' => $this->location,
            'like_count' => $this->like_count,
            'comment_count' => $this->like_count,
            'share_count' => $this->like_count,
            'is_archived' => $this->is_archived,
            'is_pinned' => $this->is_pinned,
            'posted_at' => $this->posted_at,
            'attachments' => PostAttachmentResource::collection($this->attachments),
            'created_at' => $this->created_at
        ];
    }
}
