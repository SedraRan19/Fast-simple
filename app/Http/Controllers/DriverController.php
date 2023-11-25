<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Driver,Driver_payout,Driver_vehicle_category,Vehicle_category};
use Illuminate\Support\Facades\DB;
use App\Helpers\PermissionHelper;

class DriverController extends Controller
{
    public function index_driver(){
        if(PermissionHelper::control('Manage Drivers') == false)abort(404, 'Page Not Found');
        $user = auth()->user();
        $drivers = Driver::where('user_id',$user->parent_id)->get();
        return view('driver.index',compact('drivers'));
    }
    public function driver_list(){
        $user = auth()->user();
        $drivers = Driver::where('user_id',$user->parent_id)->get();
        return view('driver.table.driver_list',compact('drivers'));
    }

    public function index_create_driver(){
        if(PermissionHelper::control('Manage Drivers') == false)abort(404, 'Page Not Found');
        return view('driver.create');
    }

    public function index_detail_driver($id){
        if(PermissionHelper::control('Manage Drivers') == false)abort(404, 'Page Not Found');
        $user = auth()->user();
        $driver = Driver::find($id);
        $dvcs = Driver_vehicle_category::where('driver_id',$id)->get();
        $categories = Vehicle_category::where('user_id',$user->parent_id)->get();
        return view('driver.detail',compact('dvcs','driver','categories'));
    }
    public function list_detail_driver($id){
        $driver = Driver::find($id);
        $dvcs = Driver_vehicle_category::where('driver_id',$id)->get();
        return view('driver.table.dvc_list',compact('dvcs','driver'));
    }

    public function index_edit_driver($id){
        if(PermissionHelper::control('Manage Drivers') == false)abort(404, 'Page Not Found');
        $driver = Driver::find($id);
        return view('driver.edit',compact('driver'));
    }

    public function search_driver(Request $req){
        $user = auth()->user();
        $drivers = Driver::where('user_id',$user->parent_id);
        $drivers = $drivers->where(function ($query) use ($req){
            $query->where('first_name', 'LIKE', '%'.$req->search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$req->search.'%')
                ->orWhere('phone', 'LIKE', '%'.$req->search.'%');
        })->get();
        return view('driver.table.driver_list',compact('drivers'));
    }

    public function delete_driver($id){
        try {
            DB::beginTransaction();
            $driver = Driver::find($id);
            $driver->delete();
            DB::commit();
            return back()->with('success','driver delete successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error');  
        }
    }

    public function store_driver(Request $req){
        try {
            DB::beginTransaction();
            $user = auth()->user();
                $driver = Driver::create([
                    'first_name'=>$req->first_name,
                    'last_name'=>$req->last_name,
                    'email'=>$req->email,
                    'phone'=>$req->phone,
                    'payment_method'=>$req->payment_method,
                    'user_id'=>$user->parent_id,
                ]);
            DB::commit();
            return back()->with('success','driver save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }

    public function update_driver(Request $req,$id){
        try {
            DB::beginTransaction();
            $driver = Driver::find($id);
            $driver->update([
                'first_name'=>$req->first_name,
                'last_name'=>$req->last_name,
                'email'=>$req->email,
                'phone'=>$req->phone,
                'payment_method'=>$req->payment_method,
            ]);
            DB::commit();
            return back()->with('success','driver save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }

    public function store_dvc(Request $req,$id){
        try {
            DB::beginTransaction();
                $dvc = Driver_vehicle_category::create([
                    'driver_id'=>$id,
                    'vehicle_category_id'=>$req->vehicle_category_id,
                    'name'=>$id,
                    'price_per_hour'=>$req->price_per_hour,
                    'price_per_mile'=>$req->price_per_mile,
                    'base_price'=>$req->base_price,
                    'included'=>$req->included,
                    'percentage'=>$req->percentage,
                    'payout_calculation'=>$req->payout_calculation,
                ]);
            DB::commit();
            return back()->with('success','driver detail save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
    public function delete_dvc($id){
        try {
            DB::beginTransaction();
            $dvc = Driver_vehicle_category::find($id);
            $dvc->delete();
            DB::commit();
            return back()->with('success','driver detail delete successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error');  
        }
    }
    public function edit_dvc(Request $req){
        try {
            DB::beginTransaction();
            $dvc = Driver_vehicle_category::find($req->dvc_id);
                $dvc->update([
                    'vehicle_category_id'=>$req->vehicle_category_id,
                    'price_per_hour'=>$req->price_per_hour,
                    'price_per_mile'=>$req->price_per_mile,
                    'base_price'=>$req->base_price,
                    'included'=>$req->included,
                    'percentage'=>$req->percentage,
                    'payout_calculation'=>$req->payout_calculation,
                ]);
            DB::commit();
            return back()->with('success','driver detail save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();  
        }
    }
}
