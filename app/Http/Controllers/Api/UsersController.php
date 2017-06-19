<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {
    public function me(Request $request)
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['unauthenticated'], 401);
        }

        $user = User::with('profile', 'userGroup')
            ->where('id', $user->id)
            ->first();

        return response()->json($user, 200);
    }
}