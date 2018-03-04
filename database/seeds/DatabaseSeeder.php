<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);

        $faker = Faker::create();

        //helping variables
        $number_of_users = 30;
        $password = 'test1234';


        //loop - create 30 users with random dana
        for($i = 0;$i <= $number_of_users;$i++){
           $sex = $faker->randomElement(['m','f']);
            switch($sex){
                case 'm':
                $name = $faker->firstNameMale.' '.$faker->lastName;
                $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
                break;

                case 'f':
                $name = $faker->firstNameFemale.' '.$faker->lastName;
                $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
                break;
            }
           DB::table('users')->insert([
                'name'=> $name,
                'email'=> str_replace('-','',str_slug($name)).'@'.$faker->safeEmailDomain,
                'password'=> bcrypt($password),
                'avatar' => $avatar,
                'sex'=> $sex,
           ]); 
            
        }
    }
}
