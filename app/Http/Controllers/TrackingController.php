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

    public function getLocations(Request $request, $userId)
    {
        $startDate = Carbon::today('Asia/Manila')->toDateTimeString();
        $endDate = Carbon::today('Asia/Manila')->toDateTimeString();

        if ($request->has('start') && $request->has('end')) {
            $startDate = Carbon::createFromTimestamp(strtotime($request->get('start')))->toDateTimeString();
            $endDate = Carbon::createFromTimestamp(strtotime($request->get('end')))->toDateTimeString();
        }

        $locations = UserLocation::where('user_id', $userId)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();

        $result = [];
        foreach ($locations as $location) {
            $result[] = [$location->lat, $location->lng];
        }

        return response()->json($result, 200);
    }
}
