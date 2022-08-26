<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')
            ->withUsers(User::where('company_id', Auth::user()->company_id)->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create')
            ->withRoles(Role::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['company_id' => Auth::user()->company_id]);
        $request->merge(['password' => Hash::make($request->password)]);
        
        $request = array_filter($request->toArray());
        
        unset($request['_token']);

        $role = $request['role'];
        unset($request['role']);

        $user = User::create($request);

        $user->assignRole($role);

        return redirect()->route('admin.users.edit', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('admin.users.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if($user->company_id == Auth::user()->company_id)
        {
            return view('admin.users.edit')
                ->withUser($user)
                ->withRoles(Role::all());
        }
        else
        {
            abort(401);
        }
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
        if($request->has('password'))
        {
            $request->merge(['password' => Hash::make($request->password)]);
        }
        
        $user = User::find($id);

        $user->update($request->except(['_token', 'role']));

        $user->syncRoles($request->role);

        return redirect()->route('admin.users.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('admin.users.index');
    }
}
