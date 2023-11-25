<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Plan,Permission,Plan_permission};
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index_plan(){
        $plans = Plan::all();
        return view('plan.list-plans',compact('plans'));
    }
    public function index_manage_plan(){
        $plans = Plan::all();
        return view('plan.index',compact('plans'));
    }
    public function edit_plan($id){
        $plan = Plan::find($id);
        $permissions = Permission::all();
        return view('plan.edit',compact('plan','permissions'));
    }
    public function index_create_plan(){
        $permissions = Permission::all();
        return view('plan.create',compact('permissions'));
    }
    public function delete_plan($id){
        try {
            DB::beginTransaction();
                $plan = Plan::find($id);
                if (!$plan) throw new \Exception('Role not found');
                $permissions = Plan_permission::where('plan_id',$plan->id);
                foreach ($permissions as $pr){
                    $pr->delete();
                }
                $plan->delete();
            DB::commit();
            return back()->with('success','Role deleted successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
    
    public function store_plan(Request $req){
        try {
            DB::beginTransaction();
                $plan = Plan::create([
                    'name'=>$req->name,
                    'price'=>$req->price,
                    'frequency'=>$req->frequency,
                    'no_of_users_included'=>$req->no_of_users_included,
                    'price_per_additional_user'=>$req->price_per_additional_user,
                    'description'=>$req->description,
                ]);

                $permissionIds = $req->input('permission',[]);

                foreach($permissionIds as $permissionId){
                    $plans = Plan_permission::create([
                        'plan_id'=>$plan->id,
                        'permission_id'=>$permissionId,
                    ]);
                }

            DB::commit();
            return back()->with('success','driver detail save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
    public function update_plan(Request $req,$id){
        try {
            DB::beginTransaction();
            $plan = Plan::find($id);
                $plan->update([
                    'name'=>$req->name,
                    'price'=>$req->price,
                    'frequency'=>$req->frequency,
                    'no_of_users_included'=>$req->no_of_users_included,
                    'price_per_additional_user'=>$req->price_per_additional_user,
                    'description'=>$req->description,
                ]);

                $permissionIds = $req->input('permission',[]);
                Plan_permission::where('plan_id',$plan->id)->delete();

                foreach($permissionIds as $permissionId){
                    $plans = Plan_permission::create([
                        'plan_id'=>$plan->id,
                        'permission_id'=>$permissionId,
                    ]);
                }
            DB::commit();
            return back()->with('success','driver detail save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
}