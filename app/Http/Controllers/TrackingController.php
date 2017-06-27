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
    public function showNegotiators()
    {
        $users = User::where('user_group_id', '3')->get();

        return view('admin.tracking.show',compact('users'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showVehicles()
    {
        $users = User::where('user_group_id', '4')->get();

        return view('admin.tracking.show',compact('users'));
    }

    public function getLastLocations($userId)
    {
        $location = UserLocation::where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->first();

        $user = User::where('id', $userId)
            ->first();

        $data = [
            "user"  => $user->profile->first_name . " " . $user->profile->last_name,
            "coordinates" => [
                "lat" => $location->lat,
                "lng" => $location->lng
            ]
        ];

        return response()->json($data, 200);
    }

    public function getLocations(Request $request, $userId)
    {
        $startDate = Carbon::today('Asia/Manila')->setTime(0,0,0)->toDateTimeString();
        $endDate = Carbon::today('Asia/Manila')->setTime(23,0,0)->toDateTimeString();

        if ($request->has('start') && $request->has('end')) {
            $startDate = Carbon::createFromTimestamp(strtotime($request->get('start')))->toDateTimeString();
            $endDate = Carbon::createFromTimestamp(strtotime($request->get('end')))->toDateTimeString();
        }

        $locations = UserLocation::where('user_id', $userId)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();

        $user = User::where('id', $userId)
            ->first();

        $result = [
            "user"  => $user->profile->first_name . " " . $user->profile->last_name,
            "coordinates"   => []
        ];
        foreach ($locations as $location) {
            $result['coordinates'][] = [$location->lat, $location->lng];
        }

        return response()->json($result, 200);
    }
}
