<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateHitRequest;
use App\Models\Hit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HitsController extends Controller {

    public function store(CreateHitRequest $request, $projectId)
    {
        $input = $request->all();

        $hit = [
            'user_id'               => $request->user()->id,
            'project_id'            => $projectId,
            'hit_timestamp'         => isset($input['hit_timestamp']) ? $input['hit_timestamp'] : Carbon::now()->toDateTimeString(),
            'name'                  => $input['name'],
            'email'                 => $input['email'],
            'contact_number'        => $input['contact_number'],
            'school_name'           => $input['school_name'],
            'designation'           => $input['designation'],
            'address'               => $input['address'],
            'other_details'         => isset($input['other_details']) ? $input['other_details'] : '',
            'image'                 => '',
            'location'              => $input['location']
        ];

        $newHit = Hit::create($hit);

        return response()->json($newHit, 201);
    }

    public function updateImage(Request $request, $hitId)
    {
        \Log::info($request);
        \Log::info($request->all());
        if (! $request->hasFile('image')) {
            return response()->json('no image found', 400);
        }

        $filename = uniqid().'.jpeg';
        $path = $request->file('image')->storeAs('public', $filename);

        $hit = Hit::where('id', $hitId)
            ->update([
                'image' => $filename
            ]);

        $hit = Hit::where('id', $hitId)->first();

        return response()->json($hit);
    }

    public function byProject(Request $request, $projectId)
    {
        $user =  $request->user()->id;

        $hits = Hit::where('user_id', $user)
            ->where('project_id', $projectId)
            ->get();

        return response()->json($hits, 201);
    }
}