<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->call('media-library:clean');

        Admin::factory()->createOne([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
        ]);

        $this->command->info('Default Admin Information:');

        $this->command->warn('Email : admin@demo.com');
        $this->command->warn('Password : password');

        $this->command->info('Default Customer Information:');

        $this->command->warn('Email : customer@demo.com');
        $this->command->warn('Password : password');

        $this->command->warn('Do not consider seed dummy data while in production mode!');
        $seedDummyData = $this->command->confirm('Are you want to seed dummy data?', false);

        if ($seedDummyData) {
            $this->call([
                DummyDataSeeder::class,
            ]);
        }
    }
}
