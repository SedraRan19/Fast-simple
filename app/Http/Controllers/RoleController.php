<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Role,Permission,Permission_role};
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index_role(){
        return view('role.list-roles');
    }

    public function role_list(){
        $roles = Role::all();
        return view('role.table.role_list',compact('roles'));
    }

    public function search_role(Request $req){
        $roles = Role::where(function ($query) use ($req){
            $query->where('name', 'LIKE', '%'.$req->search.'%');
        })->get();
        return view('role.table.role_list',compact('roles'));
    }

    public function index_manage_role(){
        $permissions = Permission::all();
        return view('role.manage-roles',compact('permissions'));
    }   


    public function edit_role($id)  {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('role.edit',compact('role','permissions'));
    }

    public function delete_role($id){
        try {
            DB::beginTransaction();
                $role = Role::find($id);
                if (!$role) throw new \Exception('Role not found');
                $permission_roles = Permission_role::where('role_id',$role->id);
                foreach ($permission_roles as $pr){
                    $pr->delete();
                }
                $role->delete();
            DB::commit();
            return back()->with('success','Role deleted successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }

    public function store_role(Request $req){
        try {
            DB::beginTransaction();
                $role = Role::create([
                    'name'=>$req->name,
                ]);

                $permissionIds = $req->input('permissions', []);

                foreach ($permissionIds as $permissionId){
                    Permission_role::create([
                        'role_id'=>$role->id,
                        'permission_id'=>$permissionId,
                        'comment'=>''
                    ]);
                }
            DB::commit();
            return back()->with('success','Role save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
    public function update_role(Request $req,$id){
        try {
            DB::beginTransaction();
            $role = Role::find($id);
            $role->update([
                'name'=>$req->name,
            ]);

            $permissionIds = $req->input('permissions', []);
            Permission_role::where('role_id', $role->id)->delete();

            foreach ($permissionIds as $permissionId){
                Permission_role::create([
                    'role_id'=>$role->id,
                    'permission_id'=>$permissionId,
                    'comment'=>''
                ]);
            }
            DB::commit();
            return back()->with('success','Role save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
}
