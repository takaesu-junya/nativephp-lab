<?php

namespace App\Providers;

use App\Events\MyEvent;
use Native\Laravel\Facades\Window;
use Native\Laravel\Contracts\ProvidesPhpIni;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Menu\Menu;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        MenuBar::create()
            // ->route('/about')
            ->width(300)
            ->height(300)
            ->showDockIcon();

        Menu::new()
            ->appMenu()
            ->editMenu()
            ->submenu(
                'ネイティブPHP',
                Menu::new()
                    ->link('https://nativephp.com', 'おれおれおれおれおれおれおれ')
                    ->link('https://nativephp.com', 'おれおれおれおれおれおれおれ')
            )
            ->submenu(
                'About',
                Menu::new()
                    ->link('https://beyound.com', 'Beyound Code')
                    ->separator()
                    ->label('it\'s me Mario')
            )
            ->submenu(
                'View',
                Menu::new()
                    ->toggleFullscreen()
                    ->separator()
                    ->link('https://laravel.com', 'Learn More', 'CmdOrCtrl+L')
                    ->event(MyEvent::class, 'Triger my event', 'CmdOrCtrl+Shift+D')
            )
            ->register();


        Window::open()
            ->width(400)
            ->height(400)
            ->showDevTools(false);
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [];
    }
}
