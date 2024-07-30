<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Quran\API\Settings\SettingsController;
use App\Models\Quran\Chapter\Chapter;
use App\Models\Quran\DeviceInfo\DeviceInfo;
use App\Models\Quran\Dhikr\Dhikr;
use App\Models\Quran\Dua\Dua;
use App\Models\Quran\HaramCode\HaramCode;
use App\Models\Quran\SifatName\SifatName;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function getDashboardInformation(): \Illuminate\Http\JsonResponse
    {
        $data = [];
        $dua = Dua::query()->count();
        $dhikr = Dhikr::query()->count();
        $sifatName = SifatName::query()->count();
        $haramCodes = HaramCode::query()->count();
        $chapter = Chapter::query()->count();
        $users = User::query()->count();

        $data = [
            'dua' => $dua,
            'dhikr' => $dhikr,
            'sifatName' => $sifatName,
            'haramCode' => $haramCodes,
            'chapter' => $chapter,
            'users' => $users,
        ];
        $ipAddress = env('IS_DEMO_VERSION') ? '103.161.68.149' : request()->ip();

        resolve(SettingsController::class)->getDeviceInfo($ipAddress);

        return response()->json([
            'status' => true,
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);
    }

    public function getOsInfo(): \Illuminate\Http\JsonResponse
    {
        // Group by 'os' and get the sum of counts for each OS
        $osCounts = DeviceInfo::query()->whereNot('os', 'Unknown')->groupBy('os')
            ->select('os', DB::raw('sum(count) as user_count'))
            ->get();

        // Extract OS labels and user counts from the result
        $osLabels = $osCounts->pluck('os')->toArray();
        $osUserCounts = $osCounts->pluck('user_count')->toArray();

        // Initialize the response data
        $data = ['labels' => $osLabels, 'series' => array_map('intval', $osUserCounts)];

        // Return the JSON response
        return response()->json([
            'status' => true,
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);
    }

    public function getCountryInfo(): \Illuminate\Http\JsonResponse
    {
        // Group by 'os' and get the sum of counts for each OS
        $osCounts = DeviceInfo::query()
            ->whereNot('os', 'Unknown')
            ->groupBy('country')
            ->select('country', DB::raw('sum(count) as user_count'))
            ->get();

        // Extract OS labels and user counts from the result
        $osLabels = $osCounts->pluck('country')->toArray();
        $osUserCounts = $osCounts->pluck('user_count')->toArray();

        // Initialize the response data
        $data = ['labels' => $osLabels, 'series' => array_map('intval', $osUserCounts)];

        // Return the JSON response
        return response()->json([
            'status' => true,
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);
    }

}
