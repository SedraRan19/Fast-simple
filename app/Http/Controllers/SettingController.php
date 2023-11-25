<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Setting};
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index_setting(){
        $user = auth()->user();
        $setting = Setting::where('user_id',$user->parent_id)->first();
        return view('settings.create',compact('setting'));
    }

    public function updateOrCreate_setting(Request $request)
    {
        try {
            $user = auth()->user();
            $setting = Setting::where('user_id', $user->parent_id)->first();

            if ($setting) {
                $setting->update([
                    'smtp_host' => $request->smtp_host ?? '',
                    'smtp_username' => $request->smtp_username ?? '',
                    'smtp_password' => $request->smtp_password ?? '',
                    'smtp_port' => $request->smtp_port ?? '',
                    'smtp_address' => $request->smtp_address ?? '',
                    'stripe_public_key' => $request->stripe_public_key ?? '',
                    'stripe_secret_key' => $request->stripe_secret_key ?? '',
                    'cancellation_policy' => null,
                    'disclaimer_policy' => null,
                ]);

                return back()->with('success', 'Modification saved');
            } else {
                Setting::create([
                    'user_id' => $user->id,
                    'smtp_host' => $request->smtp_host ?? '',
                    'smtp_username' => $request->smtp_username ?? '',
                    'smtp_password' => $request->smtp_password ?? '',
                    'smtp_port' => $request->smtp_port ?? '',
                    'smtp_address' => $request->smtp_address ?? '',
                    'stripe_public_key' => $request->stripe_public_key ?? '',
                    'stripe_secret_key' => $request->stripe_secret_key ?? '',
                    'cancellation_policy' => null,
                    'disclaimer_policy' => null,
                ]);

                return back()->with('success', 'Save setting');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'An error occurred')->withInput();
        }
    }

}
