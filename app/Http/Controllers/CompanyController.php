<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Company};
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index_my_account(){
        $user = auth()->user();
        $company = Company::where('user_id', $user->id)->firstOrNew([
            'user_id' => $user->id,
        ]);
        if (!$company->exists) {
            $company->name = 'Default Name';
            $company->address = 'Default Address';
            $company->registration = 'Default Registration';
            // Ajoutez d'autres valeurs par défaut au besoin.
        }
        $company->save();
        return view('company.my-account',compact('company','user'));
    }

    public function update_company(Request $request,$id){
        try {
            DB::beginTransaction();
                $company = Company::find($id);
                $company->update([
                    'name'=>$request->name,
                    'address'=>$request->address,
                    'registration'=>$request->registration,
                ]);
            DB::commit();
            return back()->with('success','Company save');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Error saving card')->withInput();
        }
    }
}
