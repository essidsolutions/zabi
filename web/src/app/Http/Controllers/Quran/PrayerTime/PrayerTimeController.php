<?php

namespace App\Http\Controllers\Quran\PrayerTime;

use App\Http\Controllers\Controller;
use App\Models\Quran\Prayer\PrayerTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrayerTimeController extends Controller
{
    public function columns(): array
    {
        return [
            'id',
            'date',
            'sunrise',
            'sunset',
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

    public function index()
    {
        // Fetch all records from the database
        $prayerTime = PrayerTime::query()->select($this->columns())->get();

        // Create a collection of all months in the desired format
        $allMonths = collect(range(1, 12))->mapWithKeys(function ($month) {
            return [Carbon::create(null, $month, 1)->format('F') => []];
        });

        // Group the records by month
        $groupedData = $prayerTime->groupBy(function ($item) {
            return date('F', strtotime($item->date));
        });

        // Convert the grouped data to array and then sort by month
        $groupedDataArray = $groupedData->toArray();
        ksort($groupedDataArray);

        // Merge the grouped data with all months collection
        return $allMonths->merge($groupedDataArray)->all();

    }


    public function validation(): array
    {
        $currentYear = now()->year;

        return \request()->validate([
            'date' => [
                'required',
                'date',
                "after_or_equal:{$currentYear}-01-01",
                "before_or_equal:{$currentYear}-12-31"
            ],
            'sunrise' => ['required', 'date_format:H:i'],
            'sunset' => ['required', 'date_format:H:i'],
            'fajr_azan' => ['required', 'date_format:H:i'],
            'fajr_jamat' => ['required', 'date_format:H:i'],
            'zuhr_azan' => ['required', 'date_format:H:i'],
            'zuhr_jamat' => ['required', 'date_format:H:i'],
            'asr_azan' => ['required', 'date_format:H:i'],
            'asr_jamat' => ['required', 'date_format:H:i'],
            'maghrib_azan' => ['required', 'date_format:H:i'],
            'maghrib_jamat' => ['required', 'date_format:H:i'],
            'isha_azan' => ['required', 'date_format:H:i'],
            'isha_jamat' => ['required', 'date_format:H:i'],
            'sehri_end' => ['nullable', 'date_format:H:i'],
            'iftar_start' => ['nullable', 'date_format:H:i'],
        ], [
            'date.after_or_equal' => 'The date must be on or after January 1, ' . $currentYear,
            'date.before_or_equal' => 'The date must be on or before December 31, ' . $currentYear,
        ]);
    }

    public function store(Request $request)
    {
        $this->validation();

        PrayerTime::query()->updateOrCreate(
            ['date' => $request->date],
            [
                'sunrise' => $request['sunrise'],
                'sunset' => $request['sunset'],
                'fajr_azan' => $request['fajr_azan'],
                'fajr_jamat' => $request['fajr_jamat'],
                'zuhr_azan' => $request['zuhr_azan'],
                'zuhr_jamat' => $request['zuhr_jamat'],
                'asr_azan' => $request['asr_azan'],
                'asr_jamat' => $request['asr_jamat'],
                'maghrib_azan' => $request['maghrib_azan'],
                'maghrib_jamat' => $request['maghrib_jamat'],
                'isha_azan' => $request['isha_azan'],
                'isha_jamat' => $request['isha_jamat'],
                'sehri_end' => $request['sehri_end'],
                'iftar_start' => $request['iftar_start'],
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Prayer time created successfully',
        ]);
    }


    public function show(PrayerTime $prayer_time)
    {
        return $prayer_time;
    }

    public function update(Request $request, PrayerTime $prayerTime)
    {
        $this->validation();


        PrayerTime::query()->updateOrCreate(
            ['date' => $request->date],
            [
                'sunrise' => $request['sunrise'],
                'sunset' => $request['sunset'],
                'fajr_azan' => $request['fajr_azan'],
                'fajr_jamat' => $request['fajr_jamat'],
                'zuhr_azan' => $request['zuhr_azan'],
                'zuhr_jamat' => $request['zuhr_jamat'],
                'asr_azan' => $request['asr_azan'],
                'asr_jamat' => $request['asr_jamat'],
                'maghrib_azan' => $request['maghrib_azan'],
                'maghrib_jamat' => $request['maghrib_jamat'],
                'isha_azan' => $request['isha_azan'],
                'isha_jamat' => $request['isha_jamat'],
                'sehri_end' => $request['sehri_end'],
                'iftar_start' => $request['iftar_start'],
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Prayer time updated successfully',
        ]);
    }

    public function destroy(PrayerTime $prayerTime)
    {
        $prayerTime->delete();

        return response()->json([
            'status' => true,
            'message' => 'Prayer time deleted successfully',
        ]);
    }

}
