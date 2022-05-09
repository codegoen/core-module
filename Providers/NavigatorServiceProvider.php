<?php

namespace Modules\Core\Providers;

use Modules\Core\Entities\User;
use Nedwors\Navigator\Facades\Nav;
use Illuminate\Support\ServiceProvider;

class NavigatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Nav::define(function (User $user) {
            return [
                Nav::item(__('Overview'))->subItems(
                    [
                        Nav::item(__('Dashboard'))
                            ->for('/dashboard')
                            ->heroicon('HomeIcon')
                            ->icon('outline'),

                        Nav::item(__('Api Docs'))
                            ->for('/api/documentation')
                            ->heroicon('DocumentTextIcon')
                            ->icon('outline'),

                        Nav::item(__('Setting'))
                            ->for('#')
                            ->heroicon('CogIcon')
                            ->icon('outline'),
                    ],
                ),
            ];
        }, 'core');
    }
}
