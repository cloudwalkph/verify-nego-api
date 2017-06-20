<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HitsController extends Controller {

    public function store(Request $request, $projectId)
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
            'name'                  => isset($input['name']) ? $input['name'] : '',
            'email'                 => isset($input['email']) ? $input['email'] : '',
            'contact_number'        => isset($input['contact_number']) ? $input['contact_number'] : '',
            'school_name'           => isset($input['school_name']) ? $input['school_name'] : '',
            'designation'           => isset($input['designation']) ? $input['designation'] : '',
            'address'               => isset($input['address']) ? $input['address'] : '',
            'other_details'         => isset($input['other_details']) ? $input['other_details'] : '',
            'image'                 => $filename,
            'location'              => isset($input['location']) ? $input['location'] : ''
        ];

        $newHit = Hit::create($hit);

        return response()->json($newHit, 200);
    }
}