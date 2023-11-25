<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Company,Permission,Permission_role,Role};
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

class AuthenticatedController extends Controller
{
    public function index_login(){
        return view('auth.login');
    }

    public function index_forgot_password(){
        return view('auth.forgot-password');
    }

    public function index_reset_password($token,$email){
        return view('auth.reset-password',compact('token','email'));
    }

    public function index_confirm_password(){
        return view('auth.confirm-password');
    }

    public function index_verify_email(){
        return view('auth.verify-email');
    }

    public function verification_email(Request $request){
    try{
        $user = User::where('email',$request->email)->first();
        if(!$user)return back()->with(["error" => "Incorrect email"])->withInput();

        $token = Str::random(60);

        $existingToken = DB::table('password_reset_tokens')->where('email', $user->email)->first();

        if ($existingToken) {
            DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->update([
                    'token' => $token,
                    'created_at' => now(),
                ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now(),
            ]);
        }

        $resetLink = url('/reset-password'.'/'.$token.'/'.$user->email);

        // url(config('app.url').route('reset_password', ['token' => $token, 'email' => $user->email], false))
        Mail::to($user->email)->send(new ResetPasswordMail($token, $resetLink));
        return back()->with('success','check your email');
        } catch (\Throwable $th) {
            return back()->with(["error" => "Incorrect email"])->withInput();
        }
    }

    public function update_password(Request $request){
        try {
            $this->validate($request, [
                'password' => 'required|confirmed|min:8',
            ]);
            DB::beginTransaction();
            // Utilisation de $token au lieu de token dans la condition
            $token = DB::table('password_reset_tokens')->where('token', $request->token)->where('email', $request->email)->first();  
            // Correction de la condition if (!token) à if (!$token)
            if (!$token) {
                return back()->with(["error" => "Error"])->withInput();
            }
            $user = User::where('email', $request->email)->first();
            if ($request->password != $request->password_confirmation) {
                return back()->with(["error" => "Incorrect password"])->withInput();
            } else {
                $user->update(['password' => Hash::make($request->password)]);
                return redirect('/');
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(["error" => "Error"])->withInput();
        }
    }
    

    public function validation_login(Request $request){
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentification réussie
            $user = auth()->user();
            session(['user' => $user]);
            return redirect('/customers');
        } else {
            // Mot de passe incorrect
            return back()->with(["error" => "Incorrect password"])->withInput();
        }
    }

    public function disconnection(){
        auth()->logout();
        session()->forget('user');
        session()->invalidate();
        session()->regenerateToken();
        return view('auth.login');
    }

    public function index_register(){
        return view('auth.register');
    }

    public function register(Request $req){                                                                                       
        try {
            DB::beginTransaction();
            if ($req->password != $req->confirm_password){
                return back()->with('error','Incorrect password')->withInput();  
            }
            else{
                $user = User::create([
                    'email'=>$req->email,
                    'phone'=>$req->phone,
                    'role_id'=>4,
                    'password'=>Hash::make($req->password),
                ]);
                $user->update(['parent_id' => $user->id]);
                DB::commit();
                return view('company.registration',compact('user'));
            }
            
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
    public function register_company(Request $request,$id){
        try {
            DB::beginTransaction();
            $user = User::find($id);
                $company = Company::create([
                    'user_id'=>$user->id,
                    'name'=>$request->name,
                    'address'=>$request->address,
                    'registration'=>$request->registration,
                ]);
            DB::commit();
            return view('auth.login');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }

    
}


