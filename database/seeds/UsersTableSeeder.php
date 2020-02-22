<?php

use App\Models\Admin;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Admin::class)->create([
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
        ]);
        factory(Supervisor::class)->create([
            'name' => 'Mohamed Said',
            'email' => 'themsaid@gmail.com',
        ]);
        factory(Supervisor::class)->create([
            'name' => 'Dries Vints',
            'email' => 'dries.vints@gmail.com',
        ]);
        factory(Admin::class)->create([
            'name' => 'Jeffrey Way',
            'email' => 'jeffrey@laracasts.com',
        ]);
        factory(Supervisor::class)->create([
            'name' => 'Tom Witkowski',
            'email' => 'dev.gummibeer@gmail.com',
        ]);
        factory(Supervisor::class)->create([
            'name' => 'Jonas Staudenmeir',
            'email' => 'mail@jonas-staudenmeir.de',
        ]);
        factory(Admin::class)->create([
            'name' => 'Freek Van der Herten',
            'email' => 'freek@spatie.be',
        ]);
        factory(Supervisor::class)->create([
            'name' => 'Raphael Jackstadt',
            'email' => 'info@rejack.de',
        ]);
        factory(Supervisor::class)->create([
            'name' => 'Weblate (bot)',
            'email' => 'hosted@weblate.org',
        ]);

    }
}
