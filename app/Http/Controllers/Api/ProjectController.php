<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;

use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->get();
        return ProjectResource::collection($projects);
    }
}
