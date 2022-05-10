<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module;

class SettingController extends Controller
{
    public function __invoke()
    {
        $modules = Module::getModuleJson(true)->filter(fn ($v) => isset($v['setting']));

        return inertia('Core::setting/index', [
            'settings' => $modules
        ])->title(__('Setting'));
    }
}
