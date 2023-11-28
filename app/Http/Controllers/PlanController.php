<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Plan,Permission,Plan_permission,Subscribe};
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Exception\CardException;

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
    public function index_pay_plan($id){
        $plan = Plan::find($id);
        return view ('plan.subscribe',compact('plan'));
    }
    
    public function store_stripe(Request $request,$id)
    {
        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $plan = Plan::find($id);
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $plan->price * 100,
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'description' => $plan->name,
                'confirm' => true,
                'receipt_email' => $request->email,
                'return_url' => 'https://127.0.0.1:8000/plans', // Remplacez par l'URL correcte
            ]);
            
            $date_end = now();
            if ($plan->frequency == 'week') $date_end = $date_end->addWeek();
            if ($plan->frequency == 'month') $date_end = $date_end->addMonth();
            if ($plan->frequency == 'year') $date_end = $date_end->addYear();
            $subscribe = Subscribe::create([
                'user_id'=>auth()->user()->id,
                'plan_id'=>$plan->id,
                'charge_id'=>$paymentIntent->id,
                'start_date'=> now(),
                'end_date'=>$date_end,
            ]);
        } catch (CardException $th) {
            return back()->with('error','There was a problem processing your payment')->withInput();  
        }
        return back()->withSuccess('Payment done.');
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