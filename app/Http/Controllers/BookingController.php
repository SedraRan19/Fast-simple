<?php

namespace App\Http\Controllers;
use App\Models\{Customer,User,Vehicle_category,Vehicle,Driver,Booking,Permission_role};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\PermissionHelper;

class BookingController extends Controller
{
    public function index_create_booking(){
        if(PermissionHelper::control('Create Bookings') == false)Pabort(404, 'Page Not Found');
        $user = auth()->user();
        $customers = Customer::where('user_id',$user->parent_id)->get();
        $vehicle_categories = Vehicle_category::where('user_id',$user->parent_id)->get();
        return view('booking.create',compact('customers','vehicle_categories'));
    }

    public function index_step_booking(){
        if(PermissionHelper::control('Create Bookings') == false)abort(404, 'Page Not Found');
        return view('booking.step1');
    }

    public function index_manage_booking(){
        if(PermissionHelper::control('Create Bookings') == false)abort(404, 'Page Not Found');
        return view('booking.manage-booking');
    }

    public function index_trip(){
        if(PermissionHelper::control('Create Bookings') == false)abort(404, 'Page Not Found');
        return view('booking.trips-history');
    }

    public function index_confirm_booking(){
        $tempData = session('tempData', []);
        return view('booking.confirmation',compact('tempData'));
    }

    public function trip_list(){
        $user = auth()->user();
        $trips = Booking::where('user_id',$user->parent_id)
        ->orderBy('created_at', 'desc')
        ->get();
        return view('booking.table.trips',compact('trips'));
    }

    public function trip_upcoming_list(){
        $user = auth()->user();
        $trips = Booking::where('user_id', $user->parent_id)
            ->where('trip_date', '>', now())
            ->get();
        return view('booking.table.trips', compact('trips'));
    }

    public function trip_history_list(){
        $user = auth()->user();
        $trips = Booking::where('user_id', $user->parent_id)
            ->where('trip_date', '<', now())
            ->get();
        return view('booking.table.trips', compact('trips'));
    }

    public function trip_paid_list(){
        $user = auth()->user();
        $trips = Booking::where('user_id', $user->parent_id)
            ->where('status', 1)
            ->get();
        return view('booking.table.trips', compact('trips'));
    }

    public function trip_unpaid_list(){
        $user = auth()->user();
        $trips = Booking::where('user_id', $user->parent_id)
            ->where('status', 0)
            ->get();
        return view('booking.table.trips', compact('trips'));
    }

    public function search_trip(Request $req){
        $user = auth()->user();
        $trips = Booking::where('user_id', $user->parent_id)
            ->where(function ($query) use ($req) {
                $query->where('trip_date', 'LIKE', '%' . $req->search . '%')
                ->orWhereHas('customer', function ($customerQuery) use ($req) {
                        $customerQuery->where('first_name', 'LIKE', '%' . $req->search . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $req->search . '%');
                    });
            })->get();  
        return view('booking.table.trips', compact('trips'));
    }


    public function store_step_one(Request $request)
    {   
        $user = auth()->user();
        $vehicles = Vehicle::where('user_id',$user->parent_id)->get(); 
        $drivers = Driver::where('user_id',$user->parent_id)->get();  
        $name = explode(' ',$request->customer);
        $customer = Customer::where('first_name','LIKE','%'.$name[0].'%')->first();
        if(!$customer){ 
            $customer = Customer::create([
                'first_name' => $name[0],
                'last_name' => $name[1] ?? '',
                'email' => $request->new_customer_email ? $request->new_customer_email : '',
                'phone' => $request->new_customer_phone ? $request->new_customer_phone : '',
                'home_address' => '',
                'office_address' => '',
                'permanent_note' => '',
                'private_general_notes' => '',
                'driver_notes' => '',
                'user_id' => $user->parent_id, 
            ]);
        }
        $date = $request->date;
        $hour = $request->hour;
        $ampm = $request->ampm;
        $minute = $request->minute;
        $passenger_name = $request->passenger_name;         //
        $passenger_phone = $request->passenger_phone;       //
        $flight = $request->flight;                         //
        $from_location = $request->from_location;
        $to_location = $request->to_location ?? '';
        $duration = $request->duration;                     //
        $vehicle_category = $request->vehicle_category;
        $passenger = $request->passenger;                   //
        $manual_price = $request->manual_price;             
        $new_customer_email = $request->new_customer_email; //
        $new_customer_phone = $request->new_customer_phone; //

        $tempData = [
            'customer' => $customer,
            'date' => $date,
            'hour' => $hour,
            'ampm' => $ampm,
            'minute' => $minute,
            'passenger_name' => $passenger_name,
            'passenger_phone' => $passenger_phone,
            'flight' => $flight,
            'from_location' => $from_location,
            'to_location' => $to_location,
            'duration' => $duration,
            'vehicle_category' => $vehicle_category,
            'passenger' => $passenger,
            'manual_price' => $manual_price,
            'send_email'=>null,
            'add_disclaimer'=>null,
            'vehicle_id'=>null,
            'driver_id'=>null,
        ];
        session(['tempData' => $tempData]);

        return view('booking.step1', compact(
            'vehicles',
            'drivers',
            'customer',
            'date',
            'hour',
            'ampm',
            'minute',
            'passenger_name',
            'passenger_phone',
            'flight',
            'from_location',
            'to_location',
            'duration',
            'vehicle_category',
            'passenger',
            'manual_price',
        ));
    }
    public function store_step_two(Request $request){
        // try {
            $tempData = session('tempData', []);
            $tempData['send_email'] = $request->send_email;
            $tempData['add_disclaimer'] = $request->add_disclaimer;
            $tempData['vehicle_id'] = $request->vehicle_id;
            $tempData['driver_id'] = $request->driver_id;
    
            $customer = Customer::findorFail($tempData['customer']->id);
            $customer->update([
                'email' => $request->customer_email ,
                'phone' => $request->customer_phone ,
            ]);
            $user = auth()->user();
            $booking = Booking::create([
                'from_location'=>$tempData['from_location'],
                'to_location'=>$tempData['to_location'],
                'description'=>'',
                'start_date'=>$tempData['date'],
                'end_date'=>$tempData['date'],
                'start_time'=>$tempData['hour'].':'.$tempData['minute'].''.$tempData['ampm'],
                'end_time'=>'',
                'trip_date'=>$tempData['date'],
                'passenger_count'=>$tempData['passenger'],
                'passenger_phone'=>$tempData['passenger_phone'],
                'passenger_name'=>$tempData['passenger_name'],
                'flight'=>$tempData['flight'],
                'price'=>$tempData['manual_price'],
                'duration'=>$tempData['duration'],
                'user_id'=>$user->parent_id,
                'customer_id'=>$tempData['customer']->id,
                'vehicle_category_id'=>$tempData['vehicle_category'],
                'vehicle_id'=>$tempData['vehicle_id'],
                'driver_id'=>$tempData['driver_id'],
                'driver_payout'=>$request->driver_payout,
            ]);
            session()->forget('tempData');
            // dd('tonga eto');
            return redirect('/trips');
        // } catch (\Throwable $th) {
        //     return back()->with('error','Sorry, there was an error')->withInput();  
        // }
    }
}
