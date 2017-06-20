<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Models\Project;
use App\Models\ProjectUser;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('user_group_id', 3)->get();

        return view('admin.projects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        $user = $request->user();
        $input = $request->all();
        $users = $input['user'];

        unset($input['user']);

        $input['user_id'] = $user->id;
        $input['status'] = 'active';

        $project = Project::create($input);

        foreach($users as $user)
        {
            $data['user_id'] = $user['id'];
            $project->project_user()->create($data);
        }

        return redirect('/admin/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::where('id', $id)->first();

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('user_group_id', 3)->get();
        $project = Project::where('id', $id)->first();

        return view('admin.projects.update', compact('project', 'users'));
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
        $user = $request->user();
        $input = $request->all();
        $users = $input['user'];

        unset($input['_token']);
        unset($input['user']);

        $input['user_id'] = $user->id;
        $input['status'] = 'active';


        $project = Project::where('id', $id)->update($input);
        $project = Project::where('id', $id)->first();

        ProjectUser::where('project_id', $id)->delete();
        foreach($users as $user)
        {
            $data['user_id'] = $user['id'];
            $project->project_user()->create($data);
        }

        return redirect('/admin/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::where('id', $id);
        $project->delete();

        return redirect('admin/projects');
    }
}
