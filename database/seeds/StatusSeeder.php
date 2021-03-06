<?php

use App\AppStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppStatus::create([
            'name'=>'New',
            'description'=>'New application no any proccess yet'
        ]);
        AppStatus::create([
            'name'=>'Checked',
            'description'=>'Your Application checked by HR Team'
        ]);

        AppStatus::create([
            'name'=>'Processing',
            'description'=>'Be ready for interviews soon'
        ]);

        AppStatus::create([
            'name'=>'Short List',
            'description'=>'You Are Passing and put in short list'
        ]);
        AppStatus::create([
            'name'=>'Accepted',
            'description'=>'Congratulation you are accepted to join Our Team '
        ]);
        AppStatus::create([
            'name'=>'Rejected',
            'description'=>'Thank you but sorry good luck another time '
        ]);
        AppStatus::create([
            'name'=>'Waiting List',
            'description'=>'You are good when we need to hire more we will call you thanks'
        ]);
    }
}
