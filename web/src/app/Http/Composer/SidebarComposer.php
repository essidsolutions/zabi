<?php

namespace App\Http\Composer;

use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view): void
    {
        $view->with(['data' => [
            [
                'icon' => asset('assets/img/icons/home.svg'),
                'name' => 'Dashboard',
                'url' => route('dashboard'),
                'permission' => auth()->user()->can('manage_dashboard'),
            ],
            [
                'name' => 'Prayer Times',
                'id' => 'prayer-times',
                'icon' => asset('assets/img/icons/prayer_clock.svg'),
                'permission' =>authorize_any(['create_prayer_times', 'view_prayer_times']),
                'subMenu' => [
                    [
                        'name' => "Add Prayer Time",
                        'url' => route('prayer-time-create.view'),
                        'permission' => auth()->user()->can('create_prayer_times'),
                    ],
                    [
                        'name' => "Prayer Times",
                        'url' => route('prayer-time-list.view'),
                        'permission' => auth()->user()->can('view_prayer_times'),
                    ],
                ],
            ],
            [
                'icon' => asset('assets/img/icons/dua.svg'),
                'name' => 'Dua',
                'url' => route('dua-list.view'),
                'permission' => auth()->user()->can('view_dua'),
            ],
            [
                'icon' => asset('assets/img/icons/dhikr.svg'),
                'name' => 'Dhikr',
                'url' => route('dhikr-list.view'),
                'permission' => auth()->user()->can('view_dhikrs'),
            ],
            [
                'icon' => asset('assets/img/icons/allah_icon.svg'),
                'name' => 'Sifat Name',
                'url' => route('sifat-list.view'),
                'permission' => auth()->user()->can('view_sifats'),
            ],
            [
                'icon' => asset('assets/img/icons/haram.svg'),
                'name' => 'Haram Code',
                'url' => route('haramcode-list.view'),
                'permission' => auth()->user()->can('view_haram_codes'),
            ],
            [
                'icon' => asset('assets/img/icons/roles.svg'),
                'name' => 'Roles',
                'url' => route('role-list.view'),
                'permission' => auth()->user()->can('view_roles'),
            ],
            [
                'icon' => asset('assets/img/icons/users.svg'),
                'name' => 'Users',
                'url' => route('user-list.view'),
                'permission' => auth()->user()->can('view_users'),
            ],
            [
                'icon' => asset('assets/img/icons/settings.svg'),
                'name' => 'Settings',
                'url' => route('setting.view'),
                'permission' => authorize_any(['view_setting', 'view_email_setting']),
            ],

        ]]);
    }
}
