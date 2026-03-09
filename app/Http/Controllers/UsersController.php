<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'nullable|string',
            'phone' => 'nullable|string',
            'status' => 'nullable|string',
            'book_id' => 'nullable|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        $post = Users::create(array_merge(
            $request->only([
                'name', 
                'email', 
                'role', 
                'phone', 
                'status', 
                'book_id', 
                'username'
            ]),
            ['password' => Hash::make($request->password)]
        ));

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => $post
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'role' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'status' => 'sometimes|string',
            'book_id' => 'sometimes|string',
            'username' => 'sometimes|string|unique:users,username,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        $data = $request->only([
            'name', 'email', 'role', 'phone', 'status', 'book_id', 'username'
        ]);

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully'
        ]);
    }
}