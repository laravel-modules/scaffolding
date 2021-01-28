<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Supervisor;
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

        $admin = Admin::factory()->createOne([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'phone' => '111111111',
        ]);

        $supervisor = Supervisor::factory()->createOne([
            'name' => 'Supervisor',
            'email' => 'supervisor@demo.com',
            'phone' => '222222222',
        ]);

        $customer = Customer::factory()->createOne([
            'name' => 'Customer',
            'email' => 'customer@demo.com',
            'phone' => '333333333',
        ]);

        $this->call([
            DummyDataSeeder::class,
        ]);

        $this->command->table(['ID', 'Name', 'Email', 'Phone', 'Password', 'Type', 'Type Code'], [
            [$admin->id, $admin->name, $admin->email, $admin->phone, 'password', 'Admin', $admin->type],
            [$supervisor->id, $supervisor->name, $supervisor->email, $supervisor->phone, 'password', 'Supervisor', $supervisor->type],
            [$customer->id, $customer->name, $customer->email, $customer->phone, 'password', 'Customer', $customer->type],
        ]);
    }
}
