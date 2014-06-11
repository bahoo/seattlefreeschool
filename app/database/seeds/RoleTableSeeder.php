<?php

class RoleTableSeeder extends Seeder
{
    public function run() {
        DB::table('roles')->delete();
        $admin = Role::create(array('name' => 'admin'));
        Role::create(array('name' => 'facilitator'));

        // make me an admin, of course.
        DB::table('role_user')->delete();
        User::first()->roles()->attach(array('role_id' => $admin->id));
    }
}