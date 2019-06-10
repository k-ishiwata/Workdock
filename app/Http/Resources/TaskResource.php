<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'due_at' => $this->due_at,
            'start_at' => $this->start_at,
            'time' => $this->time,
            'user_id' => $this->user_id,
            'user' => UserResource::make($this->user)
        ];
//        return parent::toArray($request);
    }
}
