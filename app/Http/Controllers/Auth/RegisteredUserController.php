<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('backend.auth.register_user');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //  return $request->all();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
             'file' => 'required|mimes:jpg,jpeg,png,pdf,docx|max:2048', 
            'password' => 'required|string|min:8',
        ]);
    
        $filePath = null;
    
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filePath = $this->storeFile('user_images',$file);
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_image' => $filePath, 
            'password' => bcrypt($request->password),
        ]);
        if ($user) {
            return redirect()->route('login')->with([
                'type' => 'success',
                'msg' => 'User registered successfully',
                'title' => 'Done!',
            ]);
        }
         else {
            return redirect()->route('register')->with([
                'type' => 'error',
                'msg' => 'Unable to register user',
                'title' => 'Fail!',
            ]);
        }
    }
        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
    
}
