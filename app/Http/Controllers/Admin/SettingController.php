<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Settings;

class SettingController extends Controller
{
    public function setting(Request $request)
    {
        $settings = Settings::first();

        return view('admin.settings.form',compact('settings'));
    }

    public function saveSettings(Request $request)
    {
        if($request->isMethod('post')){
            $setting = new Settings();
            // $setting->referral_point = $request['referral_point'];
            $setting->minimum_withdrawal_point = $request['minimum_withdrawal_point'];
            $setting->registration_bonus = $request['registration_bonus'];
            $setting->created_at = date('Y-m-d');
            $setting->save();
            return Redirect::to("admin/settings")->withSuccess('Refferral amount saved sucessfully.');
        }
    }

    public function updateSettings(Request $request)
    {
        $editedData = [];
        if($request->isMethod('post'))
        {   
            $id = $request['id'];
            $setting = Settings::findOrFail($id);
            // $setting->referral_point = $request['referral_point'];
            $setting->minimum_withdrawal_point = $request['minimum_withdrawal_point'];
            $setting->registration_bonus = $request['registration_bonus'];
            $setting->updated_at = now();
            $setting->save();
            return Redirect::to("admin/settings")->withSuccess('Refferral amount updated sucessfully.');
        }
    }
}