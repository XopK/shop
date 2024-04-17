<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    public function signIn()
    {
        return view('signIn');
    }

    public function signUp()
    {
        return view('signUp');
    }

    public function signUp_valid(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'phone' => 'required|min:11|max:12',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ], [
            'name.required' => 'Заполните поле!',
            'surname.required' => 'Заполните поле!',
            'phone.required' => 'Заполните поле!',
            'email.required' => 'Заполните поле!',
            'password.required' => 'Заполните поле!',
            'confirm_password.required' => 'Заполните поле!',
            'name.alpha' => 'Только строки!',
            'surname.alpha' => 'Только строки!',
            'phone.min' => 'Минимально 11 символов!',
            'password.min' => 'Минимально 8 символов!',
            'phone.max' => 'Максимально 12 символов!',
            'email.unique' => 'Данная почта занята!',
            'email.email' => 'Введите действительную почту!',
            'confirm_password.same' => 'Пароли не совпадают!',
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'is_admin' => 0,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            Auth::login($user);
            return redirect('/')->with('success', 'Регистрация прошла успешно!');
        } else {
            return redirect()->back()->with('error', 'Ошибка регстрации!');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function signIn_valid(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Заполните поле!',
            'email.email' => 'Введите действительную почту!',
            'password.required' => 'Заполните поле!',
            'password.min' => 'Минимально 8 символов!',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            if (Auth::user()->is_admin == 1) {
                return redirect('/admin')->with('success', 'Здраствуй админ!');
            } else {
                return redirect('/')->with('success', 'Авторизация прошла успешно!');
            }
        } else {
            return redirect()->back()->with('error', 'Ошибка авторизации!');
        }
    }
}
