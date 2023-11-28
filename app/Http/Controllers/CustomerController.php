<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Customer,Card};
use Illuminate\Support\Facades\DB;
use App\Helpers\PermissionHelper;

class CustomerController extends Controller
{
    public function index_customer(){
        if(PermissionHelper::control('Create Customers') == false)abort(404, 'Page Not Found');
        return view('customer.index');
    }
   
    public function index_create_customer(){
        return view('customer.create');
    }

    public function customer_list(){
        $user = auth()->user();
        $customers = Customer::where('user_id',$user->parent_id)->get();
        return view('customer.table.customer_list',compact('customers'));
    }

    public function index_card($id){
        $cards = Card::where('customer_id',$id)->get();
        return view('customer.card.index',compact('cards','id'));
    }

    public function index_create_card($id){
        $customer = Customer::find($id);
        return view('customer.card.create',compact('customer'));
    }
    
    public function delete_card($id){
        try {
            DB::beginTransaction();
                $card = Card::find($id);
                $card->delete();
            DB::commit();
            return back()->with('success','Card save');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Error saving card')->withInput();
        }
    }

    public function passenger_list($id){
        $user = auth()->user();
        $customers = Customer::where('user_id',$user->parent_id)
        ->where('parent_id',$id)
        ->get();
        return view('customer.table.passenger_list',compact('customers'));
    }

    public function index_create_passenger($id){
        $customer = Customer::find($id);
        return view('customer.create_passenger',compact('customer'));
    }

    public function index_passenger($id){
        $parent_id = $id;
        $user = auth()->user();
        $customers = Customer::where('user_id',$user->parent_id)
        ->where('parent_id',$id)
        ->get();
        return view('customer.passenger',compact('customers','parent_id'));
    }

    public function search_customer(Request $req){
        $user = auth()->user();
        $customers = Customer::where('user_id', $user->parent_id);
    
        $customers = $customers->where(function ($query) use ($req){
            $query->where('first_name', 'LIKE', '%'.$req->search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$req->search.'%')
                ->orWhere('phone', 'LIKE', '%'.$req->search.'%');
        })->get();
    
        return view('customer.table.customer_list', compact('customers'));
    }

    public function search_passenger(Request $req,$id){
        $user = auth()->user();
        $customers = Customer::where('user_id', $user->parent_id)
        ->where('parent_id',$id);
    
        $customers = $customers->where(function ($query) use ($req){
            $query->where('first_name', 'LIKE', '%'.$req->search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$req->search.'%')
                ->orWhere('phone', 'LIKE', '%'.$req->search.'%');
        })->get();
    
        return view('customer.table.passenger_list', compact('customers'));
    }
    

    public function delete_customer($id){
        try {
            $customer = Customer::find($id);
            $customer->delete();
            return back()->with('success','customer deleted');
        } catch (\Throwable $th) {
            return back()->with('error','error');
        }
    }

    public function store_customer(Request $req){
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $customer = Customer::create([
                'first_name'=>$req->first_name,
                'last_name'=>$req->last_name,
                'email'=>$req->email,
                'phone'=>$req->phone,
                'home_address'=>$req->home_address,
                'office_address'=>$req->office_address,
                'permanent_note'=>$req->permanent_note,
                'private_general_notes'=>$req->private_general_notes,
                'driver_notes'=>$req->driver_notes,
                'user_id'=>$user->parent_id,
            ]);
            DB::commit();
            return back()->with('success','customer save');
        } catch (\Throwable $th) {
            DB::rollback();
            dd('ERROR');
            return back()->with('error','error')->withInput();
        }
    }

    public function store_card(Request $request,$id)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();

            $card = Card::create([
                'card_number' => $request->card_number,
                'card_holder_name' => $request->card_holder_name,
                'expiration_date' => $request->expiration_date,
                'cvv' => $request->cvv,
                'zip' => $request->zip,
                'user_id' => $user->parent_id,
                'customer_id' => $id,
            ]);

            DB::commit();

            return back()->with('success', 'Card saved successfully');
        } catch (\Throwable $th) {
            DB::rollback();

            return back()->with('error', 'Error saving card')->withInput();
        }
    }

    public function store_passenger(Request $req,$id){
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $customer = Customer::create([
                'first_name'=>$req->first_name,
                'last_name'=>$req->last_name,
                'email'=>$req->email,
                'phone'=>$req->phone,
                'home_address'=>$req->home_address,
                'office_address'=>$req->office_address,
                'permanent_note'=>$req->permanent_note,
                'private_general_notes'=>$req->private_general_notes,
                'driver_notes'=>$req->driver_notes,
                'user_id'=>$user->parent_id,
                'parent_id'=>$id,
            ]);
            DB::commit();
            return back()->with('success','passenger save');
        } catch (\Throwable $th) {
            DB::rollback();
            dd('ERROR');
            return back()->with('error','error')->withInput();
        }
    }

    public function edit_customer($id){
        $customer = Customer::find($id);
        return view('customer.edit',compact('customer'));
    }

    public function update_customer(Request $req, $id){
        try {
            DB::beginTransaction();
            $customer = Customer::find($id);
            $customer->update([
                'first_name'=>$req->first_name,
                'last_name'=>$req->last_name,
                'email'=>$req->email,
                'phone'=>$req->phone,
                'home_address'=>$req->home_address,
                'office_address'=>$req->office_address,
                'permanent_note'=>$req->permanent_note,
                'private_general_notes'=>$req->private_general_notes,
                'driver_notes'=>$req->driver_notes,
            ]);
            DB::commit();
            return back()->with('success','customer save');
        } catch (\Throwable $th) {
            DB::rollback();
            dd('ERROR');
            return back()->with('error','error')->withInput();
        }
    }


    
}
