<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hit;
use Illuminate\Http\Request;

class HitsController extends Controller {

    public function store(Request $request, $userId)
    {
        $input = $request->all();
        $input['user_id'] = $userId;

        $hit = Hit::create($input);

        return response()->json($hit, 200);
    }
}