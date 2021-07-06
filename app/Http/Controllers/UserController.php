<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::with(['orders'])->get());
    }

    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        if (Auth::attempt($request->only(['email', 'password']))) {
            $status = 200;
            $response = [
                'user' => Auth::user(),
                'token' => Auth::user()->createToken('userAccess')->accessToken,
            ];
        }

        return response()->json($response, $status);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'address' => 'required|max:256',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = $request->only(['first_name', 'last_name', 'address', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('userAccess')->accessToken,
        ]);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function orders(User $user)
    {
        return response()->json($user->orders()->with(['product'])->get());
    }

}
