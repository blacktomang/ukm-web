<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class CreateRolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        Permission::create(['name' => 'register']);
        Permission::create(['name' => 'add products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'get user list']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('get user list');
        // $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['name' => 'seller']);
        $role2->givePermissionTo('add products');
        $role2->givePermissionTo('add products');
        $role2->givePermissionTo('edit products');
        $role2->givePermissionTo('register');
        
        $role3 = Role::create(['name' => 'buyer']);


        // $spatieRole = Role::where('name', '=', 'admin')->first();
        $user = User::create([
            'name' => 'admin',
            'username' => 'admin_ukm_',
            'email' =>   'admin@ukm.co.id',
            'phoneNumber' => '0812345678',
            'password' => Hash::make('admin.ukm.092021'),
            'address' => 'Desa tombolo'
        ]);

        // $user = User::create([
        //     'name' => 'seller',
        //     'username' => 'seller1',
        //     'email' =>   'admin@ukm.co.id',
        //     'phoneNumber' => '0812345678',
        //     'password' => Hash::make('admin.ukm.092021'),
        //     'address' => 'Desa tombolo'
        // ]);

        $user->assignRole($role1);

        // $role3->givePermissionTo('register');

        // // gets all permissions via Gate::before rule; see AuthServiceProvider

        // // // create demo users
        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Buyer',
        //     'password' => bcrypt('12345678'),
        //     'email' => 'buyer@test.com',
        // ]);
        // $user->assignRole($role3);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Seller',
        //     'password' => bcrypt('12345678'),
        //     'email' => 'seller@test.com',
        // ]);
        // $user->assignRole($role2);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Super-Admin User',
        //     'password' => bcrypt('12345678'),
        //     'email' => 'admin@test.com',
        // ]);
        // $user->assignRole($role1);
    }
}
