<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

use Error;

class UserController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        // dump($users);
        return view('users.index', compact('users'));
        // return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        //
        $requestedData = $request->validated();
        $requestedData['password'] = bcrypt($requestedData['password']);
        User::create($requestedData);
        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //  check if id exist or not
        $user = User::findorfail($id);  // search if ==> exist (true) , not exist (404)
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findorfail($id);
        //
        return view('users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $validatedRequst = $request->validated();  // array
            if (!empty($validatedRequst['password'])) {
                $validatedRequst['password'] = bcrypt($validatedRequst['password']);
            }
            $user = User::findorfail($id);
            $user->update($validatedRequst);
            return view("users.show", compact('user'));
            //code...
        } catch (Error $e) {
            //throw $th;
            $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findorfail($id);
        $user->delete();
        return to_route('users.index');
    }
}
