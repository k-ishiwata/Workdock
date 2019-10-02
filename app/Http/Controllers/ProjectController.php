<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TimeLog;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::OrderBy('id', 'desc')->paginate(40);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        Project::create($request->all());

        return redirect()
                ->route('projects.index')
                ->with('alert', '新しいプロジェクトを作成しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // 作業時間の合計
        $timeTotal = $project->timeLogs
            ->groupBy(function ($row) use ($project) {
                return $row->project_id === $project->id;
            })
            ->map(function ($row) {
                return $row->sum('time');
            });

        $timeTotal = $timeTotal->first();

        // 一番多い作業時間
        $maxTime = $project->timeLogs->max('time');

        $timeLogs = $project->timeLogs()->paginate(30);

        return view('projects.show', compact('project', 'timeTotal', 'maxTime', 'timeLogs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all());

        return redirect()
            ->route('projects.index')
            ->with('alert', 'プロジェクトを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()
            ->route('projects.index')
            ->with('alert', 'プロジェクトを削除しました。');
    }
}
