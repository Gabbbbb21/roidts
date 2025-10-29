<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'request_id' => $this->request_id,
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'doc_type' => $this->doc_type,
            'notes' => $this->notes,
            'action' => $this->action,
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            
            
        ];
    }
}
