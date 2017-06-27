<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\UserGroup;
use App\Models\UserLocation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_group_id', '>', '2')->get();

        return view('admin.reports.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $userId)
    {
        $user = User::where('id', $userId)
            ->with('profile')->first();

        $startDate = Carbon::today('Asia/Manila')->setTime(0,0,0)->toDateTimeString();
        $endDate = Carbon::today('Asia/Manila')->setTime(23,0,0)->toDateTimeString();

        if ($request->has('start') && $request->has('end')) {
            $startDate = Carbon::createFromTimestamp(strtotime($request->get('start')))->toDateTimeString();
            $endDate = Carbon::createFromTimestamp(strtotime($request->get('end')))->toDateTimeString();
        }

        $locations = $this->getLocationsPerHour($startDate, $endDate, $userId);
        dd($locations);
        return view('admin.reports.show', compact('user', 'locations', 'startDate', 'endDate'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request, $userId)
    {
        $user = User::where('id', $userId)
            ->with('profile')->first();

        $startDate = Carbon::today('Asia/Manila')->setTime(0,0,0)->toDateTimeString();
        $endDate = Carbon::today('Asia/Manila')->setTime(23,0,0)->toDateTimeString();

        if ($request->has('start') && $request->has('end')) {
            $startDate = Carbon::createFromTimestamp(strtotime($request->get('start')))->toDateTimeString();
            $endDate = Carbon::createFromTimestamp(strtotime($request->get('end')))->toDateTimeString();
        }

        $locations = $this->getLocationsPerHour($startDate, $endDate, $userId);

        return view('admin.reports.print', compact('user', 'locations', 'startDate', 'endDate'));
    }

    private function getLocationsPerHour($startDate, $endDate, $userId)
    {
        $locations = UserLocation::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('user_id', $userId)
            ->get()
            ->groupBy(function($d) {
                return Carbon::parse($d->created_at)->format('Y-m-d H');
            });

        $result = [];
        foreach ($locations as $location) {
            // Reverse geocoding
            $location[0]['formatted_address'] = app('geocoder')
                ->reverse($location[0]->lat, $location[0]->lng)
                ->get();

            $result[] = $location[0];
        }

        return $result;
    }
}
