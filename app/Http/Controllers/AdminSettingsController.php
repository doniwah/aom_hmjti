<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function index(SettingService $settingService)
    {
        // get setting
        $data['setting'] = $settingService->getAll();

        // return view parsing data
        return view('pages.admin.settings', $data);
    }

    public function update(SettingService $settingService, UpdateSettingRequest $request, Setting $setting)
    {
        // update
        $setting = $settingService->update($setting, $request);

        // success message
        toast('Pengaturan Berhasil Diubah', 'success');

        // back
        return redirect()->route('admin.settings');
    }
}
