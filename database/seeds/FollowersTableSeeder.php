<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users = User::all();
       $user = $users->find(351);
       $user_id = $user->id;
       $followers = User::where('id','!=','351')->get();
       $followers_id = $followers->pluck('id')->toArray();
       //var_dump($followers_id);
       $user->followers()->sync($followers_id,false);
    }
}
