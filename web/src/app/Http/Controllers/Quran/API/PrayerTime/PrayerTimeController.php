<?php

namespace App\Http\Controllers\Quran\API\PrayerTime;

use App\Http\Controllers\Controller;
use App\Models\Quran\Prayer\PrayerTime;
use Illuminate\Http\Request;

class PrayerTimeController extends Controller
{
//    public function todayPrayerTime(Request $request)
//    {
//        $request->validate([
//            'date' => ['required', 'date'],
//        ]);
//
//        $data = PrayerTime::query()
//            ->where('date', request()->get('date'))
//            ->select($this->columns())
//            ->first();
//
//        // Check if today is Friday and add the is_jumma column
//        $data['is_jumma'] = (date('l', strtotime(request()->get('date'))) == 'Friday');
//
//        return response()->json([
//            'status' => true,
//            'message' => 'Data fetched successfully',
//            'data' => $data
//        ]);
//    }

    public function todayPrayerTime(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
        ]);

        $data = PrayerTime::query()
            ->where('date', request()->get('date'))
            ->select($this->columns())
            ->first();

        // Check if today is Friday and add the is_jumma column
        $data['is_jumma'] = (date('l', strtotime(request()->get('date'))) == 'Friday');

        // Set default values for nullable fields
        $data['date'] = $data['date'] ?? '0.00';
        $data['sunrise'] = $data['sunrise'] ?? '0.00';
        $data['fajr_azan'] = $data['fajr_azan'] ?? '0.00';
        $data['fajr_jamat'] = $data['fajr_jamat'] ?? '0.00';
        $data['zuhr_azan'] = $data['zuhr_azan'] ?? '0.00';
        $data['zuhr_jamat'] = $data['zuhr_jamat'] ?? '0.00';
        $data['asr_azan'] = $data['asr_azan'] ?? '0.00';
        $data['asr_jamat'] = $data['asr_jamat'] ?? '0.00';
        $data['maghrib_azan'] = $data['maghrib_azan'] ?? '0.00';
        $data['maghrib_jamat'] = $data['maghrib_jamat'] ?? '0.00';
        $data['isha_azan'] = $data['isha_azan'] ?? '0.00';
        $data['isha_jamat'] = $data['isha_jamat'] ?? '0.00';
        $data['sehri_end'] = $data['sehri_end'] ?? '0.00';
        $data['iftar_start'] = $data['iftar_start'] ?? '0.00';

        // Add more fields as needed

        return response()->json([
            'status' => true,
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);
    }


    public function columns()
    {
        return [
            'date',
            'sunrise',
            'fajr_azan',
            'fajr_jamat',
            'zuhr_azan',
            'zuhr_jamat',
            'asr_azan',
            'asr_jamat',
            'maghrib_azan',
            'maghrib_jamat',
            'isha_azan',
            'isha_jamat',
            'sehri_end',
            'iftar_start'
        ];
    }
}
