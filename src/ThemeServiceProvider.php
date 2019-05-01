<?php

namespace NovaSnowball;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap snowball.
     *
     * @return void
     */
    public function boot()
    {
        $config = config('nova-snowball', [
          'sidebarCollapse'=> true,
          'sidebarIcons'   => true,
          'sidebarSize'    => 'normal',
        ]);

        Nova::serving(function (ServingNova $event) use ($config) {
            Nova::style('nova-snowball-theme', __DIR__.'/../resources/css/theme.css');

            if ($config['sidebarSize'] === 'normal') {
                Nova::style('nova-snowball-theme-sidebar-size', __DIR__.'/../resources/css/theme-sidebar-normal.css');
            } elseif ($config['sidebarSize'] === 'thick') {
                Nova::style('nova-snowball-theme-sidebar-size', __DIR__.'/../resources/css/theme-sidebar-thick.css');
            } else {
                Nova::style('nova-snowball-theme-sidebar-size', __DIR__.'/../resources/css/theme-sidebar-thin.css');
            }

            if ($config['sidebarIcons'] === false) {
                Nova::style('nova-snowball-theme-icons', __DIR__.'/../resources/css/theme-icons-hidden.css');
            }

            if ($config['sidebarCollapse'] === true) {
                Nova::style('nova-snowball-theme-collapse-css', __DIR__.'/../resources/css/theme-sidebar-collapse.css');
                Nova::script('nova-snowball-theme-collapse-js', __DIR__.'/../resources/js/theme-sidebar-collapse.js');
            }
        });
    }
}
