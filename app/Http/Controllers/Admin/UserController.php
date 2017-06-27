<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\UserGroup;
use App\Models\UserLocation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_groups = UserGroup::all();

        return view('admin.users.create', compact('user_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $input['password'] = bcrypt('password');

        $profile = $input['profile'];
        unset($input['profile']);

        $user = User::create($input);
        $user->profile()->create($profile);

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)
            ->with('profile')->first();

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $user_groups = UserGroup::all();

        return view('admin.users.update', compact('user', 'user_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $profile = $input['profile'];
        unset($input['profile']);
        unset($input['_token']);

        $user = User::where('id', $id)->update($input);
        $user = User::where('id', $id)->first();
        $user->profile()->update($profile);

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id);
        $user->delete();

        return redirect('admin/users');
    }

    public function importGPSData(Request $request)
    {
        if (! $request->hasFile('gps_file')) {
            $request->session()->flash('error', 'No file to upload');

            return redirect()->back();
        }

        $results = [];
        \Excel::load($request->file('gps_file'), function($reader) use (&$results, $request) {

            // reader methods
            $sheets = $reader->all();

            foreach ($sheets->toArray() as $sheet) {
                foreach ($sheet as $location) {
                    $latlng = explode(',', $location['llc']);

                    $data = [
                        'user_id'   => $request->get('user_id'),
                        'lat'   => $latlng[0],
                        'lng'   => $latlng[1],
                        'created_at' => Carbon::createFromTimestamp(strtotime($location['time']))->toDateTimeString()
                    ];

                    $results[] = $data;

                    // Create Data
                    UserLocation::create($data);
                }
            }
        });

        return redirect()->back();
    }
}
