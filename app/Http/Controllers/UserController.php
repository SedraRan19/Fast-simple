<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Role};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\PermissionHelper;

class UserController extends Controller
{
    public function index_user(){
        if(PermissionHelper::control('Manage Users') == false)abort(404, 'Page Not Found');
        return view('users.index');
    }

    public function user_list(){
        $user_auth = auth()->user();
        $users = [];
        if($user_auth->role->name == 'superAdmin')$users = User::all();
        else $users = User::where('parent_id',$user_auth->id)->get();
        return view('users.table.user_list',compact('users'));
    }

    public function edit_user($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    public function index_create_user(){
        if(PermissionHelper::control('Create Users') == false)abort(404, 'Page Not Found');
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    public function search_user(Request $req){
        $users = User::where(function ($query) use ($req){
            $query->where('first_name', 'LIKE', '%'.$req->search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$req->search.'%')
                ->orWhere('phone', 'LIKE', '%'.$req->search.'%');
        })->get();
        return view('users.table.user_list',compact('users'));
    }

    public function delete_user($id){
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->delete();
            DB::commit();
            return back()->with('success','user delete successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error');  
        }
    }

    public function store_user(Request $req){
        try {
            DB::beginTransaction();
            if ($req->password != $req->confirm_password){
                return back()->with('error','mot de passe incorrect')->withInput();  
            }
            else{
                $user_auth = auth()->user();
                $user = User::create([
                    'name'=>$req->first_name,
                    'first_name'=>$req->first_name,
                    'last_name'=>$req->last_name,
                    'email'=>$req->email,
                    'phone'=>$req->phone,
                    'role_id'=>$req->role_id,
                    'password'=>Hash::make($req->password),
                    'parent_id'=>$user_auth->id,
                ]);
                DB::commit();
                return back()->with('success','User save');  
            }
            
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
    public function update_user(Request $req,$id){
        try {
            DB::beginTransaction();
            $user = User::find($id);
                $user->update([
                    'first_name'=>$req->first_name,
                    'last_name'=>$req->last_name,
                    'email'=>$req->email,
                    'phone'=>$req->phone,
                    'role_id'=>$req->role_id,
                ]);
                DB::commit();
                return back()->with('success','User save');  
            
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
}
