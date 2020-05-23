<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $superAdminRole = Role::create(['name' => 'super-admin']);
          $seekerRole = Role::create(['name' => 'seeker']);
          $employeeRole = Role::create(['name' => 'employee']);


          $seekerRole->givePermissionTo(['edit seeker', 'delete seeker', 'add app', 'delete app']);
          $employeeRole->givePermissionTo(['edit employee', 'delete employee', 'add review', 'delete review']);


          $user = Factory(App\User::class)->create([
              'name' => 'superadmin',
              'email' => 'superadmin@gmail.com'
          ]);
          $user["password"] = Hash::make("12345678");
          $user->save();
          $user->assignRole($superAdminRole);
    }
}
