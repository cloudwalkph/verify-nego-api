<?php

namespace App\Http\Controllers;

use App\Models\Hit;
use App\Models\Project;
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

    public function export(Request $request, $projectId)
    {
        $hits = Hit::where('project_id', $projectId)
            ->get();

        $data = [];
        foreach ($hits as $hit) {
            $data[] = [
                'negotiator'          => $hit->user->profile->getFullNameAttribute(),
                'name'                => $hit->name,
                'email_address'       => $hit->email,
                'contact_number'      => $hit->contact_number,
                'school'              => $hit->school_name,
                'address'             => $hit->address,
                'designation'         => $hit->designation,
                'location'            => $hit->location,
                'other_details'       => $hit->other_details,
                'date'                => $hit->created_at,

            ];
        }

        $filename = 'hits_'.Carbon::today('Asia/Manila')->toDateString();

        \Excel::create($filename, function($excel) use ($data) {
            $excel->sheet('Sheet 1', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');;
    }
}
