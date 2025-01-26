<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as UserModel;
use App\Models\Penumpang as PenumpangModel;
use Auth;
use Hash;
use DB;

class AuthController extends Controller
{
    
    public function viewLogin()
    { 
        // Menampilkan view login
        return view('auth.login');
    }
    


    public function login(Request $request)
    {
        // Validasi Inputan login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // memastikan hanya ada 2 inputan email dan password
        $credentials = $request->only('email', 'password');

        // berikan kondisi jika credential benar maka akan diberikan role
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // jika role admin akan di redirect ke menu admin jika penumpang maka ke menu penumpang
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('penumpang.home');
            }
        }else{
            
            // berikan Pesan kegagalan cek kredential
            return back()->withErrors(['email' => 'Email atau Password Salah.']);

        }

    }




    public function viewRegister()
    {
        // Menampilkan view register
        return view('auth.register');
    }


    public function register(Request $request)
    {
        // Validasi Inputan
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'jenkel'   => ['required'],
            'alamat'   => ['required', 'string'],
        ], [
            'password.confirmed' => 'Password konfirmasi tidak cocok.', 
        ]);

        // Proses menyimpan hasli registrasi ke 2 table yakni users dan tb_penumpang
        DB::transaction(function () use ($request) {

            $user = UserModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'penumpang', 
            ]);

            // Hubungkan penumpang dengan user
            $penumpang = new PenumpangModel([
                'nama' => $request->name,
                'jenkel' => $request->jenkel,
                'alamat' => $request->alamat,
                'user_id' => $user->id, 
            ]);
            $penumpang->save();

        });

        // jika berhasil redirect dan berikan pesan success
        return redirect()->route('register')->with('success', 'Registrasi berhasil!');

    }



    public function logout()
    {
        // Fungsi Logout
        Auth::logout();

        // Redirect ke halaman login
        return redirect()->route('login');
    }

}
