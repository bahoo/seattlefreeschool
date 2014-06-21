<?php

class RoleTableSeeder extends Seeder
{
    public function run() {
        DB::table('roles')->delete();
        $admin = Role::create(array('name' => 'admin'));
        Role::create(array('name' => 'facilitator'));

        // make me (and Julian!) an admin, of course.
        DB::table('role_user')->delete();
        User::where('email', 'culvejc@gmail.com')->first()->roles()->attach(array('role_id' => $admin->id));
        User::where('email', 'julian@schrenzel.net')->first()->roles()->attach(array('role_id' => $admin->id));
    }
}