<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerView(Request $request)

    {
        $oldCart=$request->session()->has('cart') ?$request->session()->get('cart') : null;
        $cart=new Cart($oldCart);
        return view('Auth.register',compact('cart'));
    }

    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'email' => 'required|unique:users|min:2|max:255',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        Auth::login($user);
        return redirect(route('home'));
    }

    public function loginView(Request $request)
    {
        $oldCart=$request->session()->has('cart') ?$request->session()->get('cart') : null;
        $cart=new Cart($oldCart);
        return view('Auth.login',compact('cart'));
    }

    public function loginSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|min:2|max:255',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user=User::where('email',$request->email)->first();
        if (is_null($user))
        {
            $validator->errors()->add(
                'email','email ya password eshtebah ast1'
            );
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!Hash::check($request->password , $user->password))
        {
            $validator->errors()->add(
               'email','email ya password eshtebah ast2'
            );
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        Auth::login($user);
        return redirect(route('home'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
}
