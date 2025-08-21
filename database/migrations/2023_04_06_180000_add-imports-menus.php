<?php

use App\Models\ItemSubItems;
use App\Models\MenuItems;
use App\Models\Menus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $dashboard = Menus::create([
            'name' => 'Dashboard',
            'route' => 'app.dashboard',
            'icon' => 'fa-solid fa-house',
        ]);

        $settings = Menus::create([
            'name' => 'Configurações APP',
            'route' => null,
            'icon' => 'fa-solid fa-gear',
        ]);

        $settings->menuItems()->create(
            [
                'name' => 'Parametros',
                'route' => 'app.parameters.index',
            ]
        );

        $settings->menuItems()->create(
            [
                'name' => 'Navegação',
                'route' => 'app.navigations.index',
            ]
        );

        $settings->menuItems()->create(
            [
                'name' => 'Usuários',
                'route' => 'app.users.index',
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
