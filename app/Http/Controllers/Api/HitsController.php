<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateHitRequest;
use App\Models\Hit;
use Carbon\Carbon;

class HitsController extends Controller {

    public function store(CreateHitRequest $request, $projectId)
    {
        $input = $request->all();
        $filename = "";
        if ($request->hasFile('image')) {
            $filename = uniqid().'.jpeg';
            $path = $request->file('image')->storeAs('public', $filename);
        }

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
            'image'                 => $filename,
            'location'              => $input['location']
        ];

        $newHit = Hit::create($hit);

        return response()->json($newHit, 201);
    }
}