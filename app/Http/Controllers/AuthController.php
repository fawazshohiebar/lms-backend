<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\log;



class AuthController extends Controller
{
    public function index($id = null)
    {
        if ($id === null) {
            return User::all();
        } else {
            return User::find($id);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response(['message' => 'User deleted successfully']);
    }
 
    public function search($searchterm)
    {

        return  User::where('Role', 'like', '%' . $searchterm . '%')->get();
    }
    public function register(Request $request)
    {
        $fields = $request->validate([

            'Role' => 'required|string',
            'Email' => 'required|string|unique:admins,Email',
            'Password' => 'required|string|confirmed',
            'Full_name' => 'required|string',
        ]);
        $user = User::create([
            'Role' => $fields['Role'],
            'Email' => $fields['Email'],
            'Full_name' => $fields['Full_name'],
            'Password' => bcrypt($fields['Password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];



        return response($response, 201);
    }
    public function update(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return response(['message' => 'User not found'], 404);
    }

    $fields = $request->validate([
        'Role' => 'string',
        'Email' => 'string|unique:admins,Email,'.$user->id,
        'Password' => 'string|confirmed',
        'Full_name' => 'string',
    ]);

    // Update the user with the validated fields
    $user->Role = isset($fields['Role']) ? $fields['Role'] : $user->Role;
    $user->Email = isset($fields['Email']) ? $fields['Email'] : $user->Email;
    $user->Full_name = isset($fields['Full_name']) ? $fields['Full_name'] : $user->Full_name;

    if (isset($fields['Password'])) {
        $user->Password = bcrypt($fields['Password']);
    }

    $user->save();

    return response(['message' => 'User updated successfully', 'user' => $user]);
}


public function login(Request $request)
{
    $fields = $request->validate([
        'Email' => 'required|string',
        'Password' => 'required|string',
    ]);

    $user = User::where('Email', $fields['Email'])->first();

    if (!$user || !Hash::check($fields['Password'], $user->Password)) {
        // Invalid credentials
        return response([
            'message' => 'The provided credentials are incorrect.'
        ], 401);
    }

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response);
}

    public function logout(Request $request)
    {
        if (!($request->user()->currentAccessToken())) {
            return [
                'message' => 'no user logged in'
            ];
        } else {
            $request->user()->currentAccessToken()->delete();


            return [
                'message' => 'logged out'
            ];
        }
    }
}
