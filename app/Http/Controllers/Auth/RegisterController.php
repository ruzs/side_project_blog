<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Entities\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'account' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // if ($data['friend_code'] == "trykankan") {
        //     dd(99);
        // }
        // dd($data);
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['account']."@".$data['password'],
            'account' => $data['account'],
            'password' => Hash::make($data['password']),
        ]);
        if (@$data['role']) {
            $userRole=[
                "role_id"   => $data['role'],
                'model_type'=> 'App\\Entities\\User',
                'user_id'   => $user->id,
            ];

            $exists = DB::table('user_has_roles')
            ->where('user_id', $userRole['user_id'])
            ->exists();
            if ($exists) {
                DB::table('user_has_roles')
                ->where('user_id', $userRole['user_id'])
                ->update($userRole);
            }else{
                DB::table('user_has_roles')->insert($userRole);
            }
        }
        return $user;
    }
}
