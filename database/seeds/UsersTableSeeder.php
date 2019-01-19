<?php

use App\Profile;
use App\User;
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
        //
        $user = User::create([
            'name'=>'Refaat Bitar',
            'email'=>'rsv.gho@gmail.com',
            'password'=>bcrypt('ripazha'),
            'admin'=>1,
        ]);

        Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/pp.png',
            'about'=>'I am interested in applying to your Scholarship. In December 2017, I graduated from the University of Aleppo in Syria with a Bachelor degree in Mechatronics Engineering. The undergraduate five-year in this program formed the basis of my perseverance towards achieving an indent knowledge in the field of Automation Engineering. As a part of my degree course I studied various subjects relating to diverse aspects of Robotics.',
            'facebook'=>'facebook.com',
            'youtube'=>'youtube.com',
        ]);
    }
}
