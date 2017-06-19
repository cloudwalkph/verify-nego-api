<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectUser;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {
    public function me(Request $request)
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['unauthenticated'], 401);
        }

        $user = User::with('profile', 'group')
            ->where('id', $user->id)
            ->first();

        return response()->json($user, 200);
    }

    public function events(Request $request)
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['unauthenticated'], 401);
        }

        $projects = ProjectUser::where('user_id', $user->id)
            ->get();

        $events = [];
        foreach ($projects as $project) {
            if ($project->project->status === 'active') {
                $events[] = $project->project;
            }
        }

        return response()->json($events, 200);
    }
}