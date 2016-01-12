<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(CustomerTypesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(BriefingOwnersTableSeeder::class);
        $this->call(BriefingSourceTypesTableSeeder::class);
        $this->call(BriefingSourcesTableSeeder::class);
        $this->call(BriefingsTableSeeder::class);
        $this->call(BudgetTypesTableSeeder::class);

        Model::reguard();
    }
}
