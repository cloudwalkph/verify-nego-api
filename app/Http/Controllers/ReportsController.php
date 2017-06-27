<?php
namespace App\Http\Controllers;

use App\Models\UserLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller {
    public function getLocationsPerHour(Request $request, $userId)
    {
        $startDate = Carbon::today('Asia/Manila')->setTime(0,0,0)->toDateTimeString();
        $endDate = Carbon::today('Asia/Manila')->setTime(24,0,0)->toDateTimeString();

        if ($request->has('start') && $request->has('end')) {
            $startDate = Carbon::createFromTimestamp(strtotime($request->get('start')))->toDateTimeString();
            $endDate = Carbon::createFromTimestamp(strtotime($request->get('end')))->toDateTimeString();
        }

        $locations = UserLocation::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('user_id', $userId)
            ->get()
            ->groupBy(function($d) {
                return Carbon::parse($d->created_at)->format('H');
            });

        $result = [];
        foreach ($locations as $location) {
            $result[] = $location[0];
        }

        return response()->json($result, 200);
    }
}