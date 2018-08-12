<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Log the user in
     *
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email_address' => 'required',
            'password' => 'required'
        ]);

        $user = User::query()->where('email_address', $request->input('email_address'))->firstOrFail();

        if (!password_verify($request->input('password'), $user->password)) {
            abort(401, 'Incorrect email or password');
        }

        return [
            'created_at' => $user->created_at,
            'token' => $this->generateJWTToken($user)
        ];
    }

    /**
     * Register a new user
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'email_address' => 'required|unique:users,email_address|email',
            'password' => 'required'
        ]);

        $user = User::query()->create([
            'email_address' => $request->input('email_address'),
            'password' => $request->input('password')
        ]);

        return $user;
    }

    /**
     * Generate a JWT token for a user
     *
     * @param User $user
     * @return string
     */
    protected function generateJWTToken(User $user)
    {
        $payload = [
            'iss' => 'ecommerce',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60 * 60
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }
}