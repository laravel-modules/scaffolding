<?php

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
        $this->command->call('medialibrary:clean');

        \Modules\Accounts\Entities\Admin::firstOrCreate([
            'name' => 'Admin',
        ], [
            'email' => 'admin@demo.com',
            'phone' => '01098135318',
            'password' => Hash::make('password'),
        ]);

        \Modules\Accounts\Entities\Customer::firstOrCreate([
            'name' => 'Customer',
        ], [
            'email' => 'customer@demo.com',
            'phone' => '01552416535',
            'password' => Hash::make('password'),
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
