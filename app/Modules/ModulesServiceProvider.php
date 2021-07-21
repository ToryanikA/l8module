<?php

namespace App\Modules;

use Illuminate\Support\Str;
use Livewire\Livewire;

/** * Сервис провайдер для подключения модулей */
class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        //получаем список модулей, которые надо подгрузить
        $modules = config("module.modules");

        if (!empty($modules)) {
            foreach ($modules as $module) {
                //Подключаем роуты для модуля
                if (file_exists(__DIR__ . '/' . $module . '/Routes/routes.php')) {
                    $this->loadRoutesFrom(__DIR__ . '/' . $module . '/Routes/routes.php');
                }

                //Загружаем View
                //view('Test::admin')
                if (is_dir(__DIR__ . '/' . $module . '/Views')) {
                    $this->loadViewsFrom(__DIR__ . '/' . $module . '/Views', $module);
                }

                //Подгружаем миграции
                if (is_dir(__DIR__ . '/' . $module . '/Migrations')) {
                    $this->loadMigrationsFrom(__DIR__ . '/' . $module . '/Migrations');
                }

                //Подгружаем переводы
                //trans('Test::messages.welcome')
                if (is_dir(__DIR__ . '/' . $module . '/Lang')) {
                    $this->loadTranslationsFrom(__DIR__ . '/' . $module . '/Lang', $module);
                }

                if (is_dir((__DIR__ . '/' . $module . '/Livewire'))) {
                    foreach (glob(__DIR__ . '/' . $module . '/Livewire/*.php') as $fn) {
                        $fn = str_replace('.php', '', basename($fn));
                        Livewire::component(Str::kebab($fn), 'App\Modules\\'. $module . '\\Livewire\\' . $fn);
                    }

                }
            }
        }
    }

    public function register()
    {
    }
}
