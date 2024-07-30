<?php

namespace App\Http\Controllers\Quran\Settings;

use App\Http\Controllers\Controller;
use App\Services\Setting\SettingService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function __construct(SettingService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getFormattedSettings();
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => ['required', 'string'],
            'play_store_url' => 'nullable|url:https',
            'app_store_url' => 'nullable|url:https',
            'address' => ['required', 'string', 'max:50'],
        ]);


        $this->service->update();

        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully',
        ]);
    }

    public function privacySupportUpdate(Request $request)
    {

        $this->service->update();

        return response()->json([
            'success' => true,
            'message' => 'Information updated successfully',
        ]);
    }

}
