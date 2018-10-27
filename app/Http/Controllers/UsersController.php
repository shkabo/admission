<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->paginate(15);
        return view('user.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::table('roles')->orderBy('id', 'desc')->get();
        return view('user.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => 'required',
            'role' => 'required',
            'active' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('user.show.create')->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'active' => is_null($request->active) ? 0 : 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        if (!User::create($data)->id) {
            return redirect()->route('user.show.create')->with('error', "An error occurred while saving new entry. Please try again");
        }
        return redirect()->route('user.list')->with('success', 'User ' . $data['name'] . ' successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $roles = DB::table('roles')->orderBy('id', 'desc')->get();
        if (is_null($user)) {
            abort(404);
        }
        return view('user.edit', ['user' => $user, 'roles' => $roles]);
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
        //@TODO: Refactor thsis
        $user = User::find($id);
        $rules = [];
        if (is_null($user)){
            abort(404);
        }
        if ($request->has('name')) {
            $rules['name'] = ['required', 'string', 'max:255'];
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $rules['email'] = ['string', 'email', 'max:255'];
            $user->email = $request->email;
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        if ($request->has('password') && !is_null($request->password)) {
            $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
            $user->password = Hash::make($request->password);
        }
        if ($request->has('role')) {
            $user->role_id = $request->role;
        }
        $user->active = is_null($request->active) ? 0 : 1;

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('user.show.edit', $id)->withErrors($validator)->withInput();
        }
        $user->save();
        return redirect()->route('user.show.edit', $id)->with('success', 'User ' . $user->name . ' successfully modified.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
