<?php

namespace App\Models\Quran\Prayer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'sunrise',
        'sunrise_start',
        'sunrise_end',
        'sunset',
        'fajr_start',
        'fajr_azan',
        'fajr_jamat',
        'fajr_end',
        'zuhr_start',
        'zuhr_azan',
        'zuhr_jamat',
        'zuhr_end',
        'asr_start',
        'asr_azan',
        'asr_jamat',
        'asr_end',
        'maghrib_start',
        'maghrib_azan',
        'maghrib_jamat',
        'maghrib_end',
        'isha_start',
        'isha_azan',
        'isha_jamat',
        'isha_end',
        'sehri_start',
        'sehri_end',
        'iftar_start',
        'iftar_notification',
        'sehri_notification',
        'second',
        'se_notify',
    ];

    protected $dates = ['date'];

}
