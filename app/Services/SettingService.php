<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    // get setting
    public function getAll()
    {
        // get data setting limit 2
        $setting = Setting::limit(3)->get();

        return $setting;
    }

    // get where setting
    public function getWhere($id)
    {
        // get data setting limit 2
        $setting = Setting::where('id',$id)->get();
        return $setting;
    }

    // update setting
    public function update($setting, $request)
    {
        $setting->description = $request['description_'];
        $setting->opening_date = $request['opening_date'];
        $setting->closing_date = $request['closing_date'];

        $setting->save();

        return $setting;
    }
}
