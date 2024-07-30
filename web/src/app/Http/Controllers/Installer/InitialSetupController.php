<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use App\Models\Quran\Chapter\Chapter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class InitialSetupController extends Controller
{

    /**
     * @throws Exception
     */
    public function finish()
    {
        $chapterCount = Chapter::query()->count();
        if ($chapterCount == 114)
            return redirect()->route('dashboard')->with('error', 'Sorry you are already imported Quran Surah in your system.');

        try {
            DB::transaction(function () {
                config()->set('database.connections.mysql.strict', false);
                define('STDIN', fopen("php://stdin", "r"));

                Artisan::call('optimize:clear');

                Artisan::call('clear-compiled');
                Artisan::call('view:clear');

                Artisan::call('config:clear');
                Artisan::call('cache:clear');

                Artisan::call('db:seed', [
                    '--class' => 'Database\\Seeders\\DefaultSeeder',
                    '--force' => true
                ]);

                config()->set('database.connections.mysql.strict', true);
            });
            return redirect()->route('dashboard')->with('success', 'Successfully Quran Surah Imported !!');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('dashboard')->with('error', $exception->getMessage());
        }
    }
}
