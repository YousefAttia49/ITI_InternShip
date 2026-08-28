<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'data'   => $users,
        ], 200);
    }

    /**
     * Store a newly created user.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'User created successfully',
            'data'    => $user,
        ], 201);
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data'   => $user,
        ], 200);
    }

    /**
     * Update the specified user.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'User updated successfully',
            'data'    => $user,
        ], 200);
    }

    /**
     * Remove the specified user.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'User deleted successfully',
        ], 200);
    }
}
