<?php

namespace App\Http\Controllers;

use App\Models\Hit;
use App\Models\Project;
use App\Models\ProjectLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        $hits = Hit::where('project_id', $projectId)
            ->get();

        $hits = $this->parseHits($hits);


        return view('projects.show', compact('project', 'hits'));
    }

    private function parseHits($hits)
    {
        $result = [];
        foreach ($hits as $hit) {
            $hit['hit_timestamp'] = Carbon::createFromTimestamp(strtotime($hit['hit_timestamp']))
                ->minute(0)
                ->second(0)
                ->toDateTimeString();

            $result[] = $hit;
        }

        return $result;
    }

    public function preview(Request $request, $projectId)
    {
        $project = Project::find($projectId);
        $hits = Hit::where('project_id', $projectId)
            ->get();

        return view('projects.print.event', compact('project', 'hits'));
    }
}
