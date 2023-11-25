<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Vehicle,Vehicle_category};
use Illuminate\Support\Facades\DB;
use App\Helpers\PermissionHelper;

class VehicleController extends Controller
{
    public function index_vehicle(){
        if(PermissionHelper::control('Manage Vehicles') == false)abort(404, 'Page Not Found');
        return view('vehicles.index');
    }
    public function vehicle_list(){
        $user = auth()->user();
        $vehicles = Vehicle::where('user_id',$user->parent_id)->get();
        return view('vehicles.table.vehicle_list',compact('vehicles'));
    }
    public function index_create_vehicle(){
        if(PermissionHelper::control('Create Vehicles') == false)abort(404, 'Page Not Found');
        $user = auth()->user();
        $categories = Vehicle_category::where('user_id',$user->parent_id)->get();
        return view('vehicles.create',compact('categories'));
    }
    public function index_edit_vehicle($id){
        if(PermissionHelper::control('Manage Vehicles') == false)abort(404, 'Page Not Found');
        $vehicle = Vehicle::find($id);
        $user = auth()->user();
        $categories = Vehicle_category::where('user_id',$user->parent_id)->get();
        return view('vehicles.edit',compact('categories','vehicle'));
    }
    public function index_caterory_vehicle(){
        if(PermissionHelper::control('Manage Vehicles') == false)abort(404, 'Page Not Found');
        $user = auth()->user();
        $categories = Vehicle_category::where('user_id',$user->parent_id)->get();
        return view('vehicle-categories.index',compact('categories'));
    }
    public function index_create_caterory_vehicle(){
        if(PermissionHelper::control('Manage Vehicles') == false)abort(404, 'Page Not Found');
        return view('vehicle-categories.create');
    }
    public function index_edit_caterory_vehicle($id){
        if(PermissionHelper::control('Manage Vehicles') == false)abort(404, 'Page Not Found');
        $category = Vehicle_category::find($id);
        return view('vehicle-categories.edit',compact('category'));
    }

    public function delete_vehicle($id){
        try {
            $vehicle = Vehicle::find($id);
            $vehicle->delete();
            return back()->with('success','vehicle delete successfully');
        } catch (\Throwable $th) {
            return back()->with('error','Sorry, there was an error');
        }
    }
    public function search_vehicle(Request $req){
        $vehicles = Vehicle::where(function ($query) use ($req){
                $query->where('make','LIKE','%'.$req->search.'%')
                      ->orWhere('model','LIKE','%'.$req->search.'%')
                      ->orWhere('license_plate','LIKE','%'.$req->search.'%');
        })->get();
        return view('vehicles.table.vehicle_list',compact('vehicles'));
    }
    
    public function store_vehicle(Request $req){
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $vehicle = Vehicle::create([
                'make'=>$req->make,
                'model'=>$req->model,
                'license_plate'=>$req->license_plate,
                'vehicle_category_id'=>$req->vehicle_category_id,
                'user_id'=>$user->parent_id,
            ]);
            DB::commit();
            return back()->with('success','vehicle save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error');
        }
    }
    
    public function update_vehicle(Request $req,$id){
        try {
            DB::beginTransaction();
            $vehicle = Vehicle::find($id);
            $vehicle->update([
                'make'=>$req->make,
                'model'=>$req->model,
                'license_plate'=>$req->license_plate,
                'vehicle_category_id'=>$req->vehicle_category_id,
            ]);
            DB::commit();
            return back()->with('success','vehicle save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error');
        }
    }

    
    public function store_vehicle_category(Request $req){
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $category = Vehicle_category::create([
                'name'=>$req->name,
                'price_per_hour'=>$req->price_per_hour,
                'price_per_mile'=>$req->price_per_mile,
                'base_price'=>$req->base_price,
                'miles_inclided'=>$req->miles_inclided,
                'user_id'=>$user->parent_id,
            ]);
            DB::commit();
            return back()->with('success','vehicle category save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();            
        }
    }

    public function edit_vehicle_category(Request $req,$id){
        try {
            DB::beginTransaction();
            $category = Vehicle_category::find($id);
            $category->update([
                'name'=>$req->name,
                'price_per_hour'=>$req->price_per_hour,
                'price_per_mile'=>$req->price_per_mile,
                'base_price'=>$req->base_price,
                'miles_inclided'=>$req->miles_inclided,
            ]);
            DB::commit();
            return back()->with('success','vehicle category save successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error','Sorry, there was an error')->withInput();            
        }
    }
    public function delete_vehicle_category($id){
        try {
            $category = Vehicle_category::find($id);
            $category->delete();
            return back()->with('success','vehicle category delete successfully');
        } catch (\Throwable $th) {
            return back()->with('error','Sorry, there was an error');
        }
    }
}
