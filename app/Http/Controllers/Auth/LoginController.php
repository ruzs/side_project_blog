<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\RoleRepository;

class LoginController extends Controller
{
    private $data;
    private $role_repo;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleRepository $role_repo)
    {
        $this->role_repo = $role_repo;
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $this->data=[
            'bg'=>'assets/img/contact-bg.jpg',
        ];
        return view('auth.login',$this->data);
    }

    public function showRegistrationForm()
    {
        $this->data=[
            'bg'=>'assets/img/contact-bg.jpg',
            'user_roles'=>$this->role_repo->getByNotProtect()
        ];
        return view('auth.register',$this->data);
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'account';
    }
}
