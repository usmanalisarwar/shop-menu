<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request; // Add this line

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/user/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => 3,
            'company_name' => $data['company_name'],
            'password' => Hash::make($data['password']),
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);
    }

    // Override the register method to handle email verification
    public function register(Request $request) // Now Request is properly imported
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Trigger email verification
        event(new Registered($user));

        // Send verification email
        $user->sendEmailVerificationNotification();

        return redirect($this->redirectTo)->with('message', 'Please check your email to verify your account.');

    }
}
