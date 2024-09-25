<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Order;

class Testcontroller extends Controller
{
    //
    public function index(){
        // $users=User::with('contact')->get()->toArray();

        //condition
//         $users=User::withWhereHas('contact',function($query){
// //where,orderby,find from 2 table
// $query->where('phone_no',956987);
//         })->get()->toArray();
        
        //whereHas in which search 2 table but not giving data for 2 table
       

        //inverse relation
        $contacts=Contact::with('user')->get()->toArray();
        echo "<pre>";
        print_r($contacts);
        die();
    }
    public function create()
    {
        //eloquent relation insertion
       $usrobj= User::create([
'name'=>'testi',
'email'=>'sunil1@gmail.com',
'password'=>'1234567'
       ]);
       $usrobj->contact()->create([
'phone_no'=>7854120
       ]);
    }

    public function userorderindex(){
        // $orders=User::with('order')->get()->toArray();


// If you want to show don’t who haven’t have orders i.e users who don’t have any orders
// $orders=User::doesntHave('order')->get()->toArray();


// want to show who have order just opposite above function
// $orders=User::has('order')->with('order')->get()->toArray();

// want to show more than two orders
// $orders=User::has('order','>=',2)->with('order')->get()->toArray();

//want to show count only
$orders=User::withCount('order')->get()->toArray();

        echo "<pre>";
        print_r($orders);
        die();
    }
    public function orderuserindex(){
// $orders=Order::with('user')->get()->toArray();
// echo "<pre>";
//         print_r($orders);
//         die();

        //with condition
        $orders=Order::withWhereHas('user',function($query){
            //where,orderby,find from 2 table
            $query->where('id',1);
                    })->get()->toArray();
echo "<pre>";
        print_r($orders);
        die();
    }

    public function storewitheloquent(){
        $user=User::find(2);
        // you can use single create() or createMany()
        $user->order()->createMany([
[
'total_amount'=>100,
],[
'total_amount'=>200,
]

        ]);
    }

    public function userwithrole(){
        // $userwithrole=User::find(1);
        // return $userwithrole->roles;
        $userwithrole=User::with('roles')->get()->toArray();
        return $userwithrole;
    }

    public function rolewithuser(){
        //inverse relation
        $roles=Role::with('users')->get()->toArray();
        return $roles;
        $roles=$roles->users();

    }

    public function addrole()
    {
        $user=User::find(1);
        $user->roles()->attach(3);
        $roles=[2,3];//for multiple
        $user->roles()->attach($roles);
    }
    public function detachrole()
    {
        //if you don't pass any arguement in detach then it delete all roles for the particular user
        $user=User::find(1);
        $user->roles()->detach(3);
        // $roles=[2,3];//for multiple
        // $user->roles()->detach($roles);

    }
    public function syncrole()
    {
        //if you don't pass any arguement in detach then it delete all roles for the particular user
        $user=User::find(1);
        $user->roles()->sync(2);
        //it will add 3 and delete previous
        $roles=[1,3];//for multiple
        //it will add 1,3 role and delete previous
        $user->roles()->sync($roles);

    }
}
