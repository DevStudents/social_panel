<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Friend;
use App\Post;

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
        $max_post = 5;



        //loop - create 30 users with random dana
        for($user_id = 1;$user_id <= $number_of_users;$user_id++){
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
               'role_id'=> 2,
                'sex'=> $sex,
           ]);

            for($i = 1;$i <= $faker->numberBetween(0,$number_of_users -1);$i++){

                $friend_id = $faker->numberBetween(1,$number_of_users);

                $friendship_exists = Friend::where([
                        ['friend_id', '=', $friend_id],
                        ['user_id', '=', $user_id]]
                )->orWhere([
                        ['friend_id', '=', $user_id],
                        ['user_id', '=', $friend_id]]
                )->exists();

                if(!$friendship_exists && $user_id != $friend_id){
                    DB::table('friends')->insert([
                        'user_id'=> $user_id,
                        'friend_id'=> $friend_id,
                        'accepted' => $faker->numberBetween(2,3),
                        'created_at' => $faker->dateTimeThisYear('now'),
                    ]);

                }

            }//end of frends

            for($post_id = 1;$post_id <= $faker->numberBetween(0,$max_post);$post_id++){
                DB::table('posts')->insert([
                    'user_id'=> $user_id,
                    'post_content' => $faker->text($maxNbChars = 200),
                    'created_at' => $faker->dateTimeThisYear('now'),
                ]);

                $posts = Post::get();
                $counter = count($posts);
                for($comment_id = 1;$comment_id <= $faker->numberBetween($min = 1,$max = 5 );$comment_id++){
                    DB::table('comments')->insert([
                        'post_id'=> $faker->numberBetween($min = 1,$max = $counter),
                        'user_id'=> $faker->numberBetween($min = 1,$max = $number_of_users),
                        'content' => $faker->text($maxNbChars = 90),
                        'created_at' => $faker->dateTimeThisYear('now'),
                    ]);

                }//comments
            }//end of posts & comments


        }//end of user

            DB::table('roles')->insert([
                'role_name'=> 'admin',
            ]);
             DB::table('roles')->insert([
            'role_name'=> 'user',
            ]);
    }
}
