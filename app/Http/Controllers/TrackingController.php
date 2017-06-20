<?php

namespace App\Http\Controllers;

use App\Models\Hit;
use App\Models\Project;
use App\Models\ProjectLocation;
use App\Models\UserLocation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrackingController extends Controller
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
    public function show()
    {
        $users = User::where('user_group_id', '3')->get();

        return view('admin.tracking.show',compact('users'));
    }

    public function getLocations($userId)
    {
        $locations = UserLocation::where('user_id', $userId)->get();

        $result = [];
        foreach ($locations as $location) {
            $result[] = [$location->lat, $location->lng];
        }

        return response()->json($result, 200);
    }
}
