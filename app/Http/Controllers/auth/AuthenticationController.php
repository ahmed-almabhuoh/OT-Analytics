<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    // Validation function
    public function adminValidation($inputs, $rules, $msg = [])
    {
        return Validator($inputs, $rules, $msg);
    }
    //
    public function showLogin($guard = 'admin')
    {
        return response()->view('backend.auth.login', [
            'guard' => $guard,
        ]);
    }

    public function login(Request $request)
    {
        $validator = $this->adminValidation($request->only([
            'guard',
            'username',
            'password',
        ]), [
            'guard' => 'required|string|in:admin',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        //
        if (!$validator->fails()) {
            $key = 'email';
            if (is_numeric($request->post('username'))) {
                $key = 'phone';
            } else if (filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)) {
                $key = 'email';
            }
            // $key =  ? 'phone' :  ? 'email' : 'username';
            $credentials = [
                $key => $request->post('username'),
                'password' => $request->post('password'),
            ];

            if (Auth::guard($request->post('guard'))->attempt($credentials)) {

                // Update admin last login
                Admin::where('id', '=', auth($request->post('guard'))->user()->id)->update([
                    'last_login' => Carbon::now()->toDateTimeString(),
                ]);

                return response()->json([
                    'message' => 'Sign in successfully.',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Failed to login!',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        $guard = 'admin';

        if (!auth($guard)->check()) {
            $guard = '';
        }
        $request->session()->invalidate();

        return response()->view('backend.auth.login', [
            'guard' => $guard,
        ]);
    }
}
