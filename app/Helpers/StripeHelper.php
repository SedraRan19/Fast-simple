<?php
namespace App\Helpers;
use App\Models\Setting;
use Crypt;

class StripeHelper
{
    function __construct()
    {
        $this->settingModel = new Setting();
    }
    // create product & plan in Stripe
    public function createPlan($data){

        $userSetting = $this->settingModel->getUserSetting();
        if(!isset($userSetting->stripe_public_key) || !isset($userSetting->stripe_secret_key) ){
            return false;
        }

        $stripe = new \Stripe\StripeClient(

          Crypt::decrypt($userSetting->stripe_secret_key)

        );

        $createProduct = $stripe->products->create([
            'name' => $data->name,
          ]);

        $createPlan = $stripe->plans->create([
            'amount' => $data->cost * 100,
            'currency' => 'usd',
            'interval' => $data->frequency,
            'product' => $createProduct->id,
        ]);

        return [$createProduct->id,$createPlan->id];
    }

    // update product and plan in stripe

    public function updatePlan($data){
        $userSetting = $this->settingModel->getUserSetting();
        if(!isset($userSetting->stripe_public_key) || !isset($userSetting->stripe_secret_key) ){
            return false;
        }

        $stripe = new \Stripe\StripeClient(
            Crypt::decrypt($userSetting->stripe_secret_key)
        );

        $stripe->products->update($data->stripe_product_id,[
            'name' => $data->name,
        ]);

        $stripe->plans->create([
            'amount' => $data->cost * 100,
            'currency' => 'usd',
            'interval' => $data->frequency,
            'product' => $data->stripe_product_id,
        ]);

    }
}

