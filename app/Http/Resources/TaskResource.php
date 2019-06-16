<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status_id' => $this->status_id,
            'priority_id' => $this->priority_id,
            'project_id' => $this->project_id,
            'due_at' => $this->due_at ? $this->due_at->format('Y-m-d H:i:s') : null,
//            'due_at' => $this->due_at,
            'start_at' => $this->start_at,
            'time' => $this->time,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'user' => UserResource::make($this->user)
        ];
    }
}
