<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
/////////////////////////////////////////////////////
use Illuminate\Http\Request;
use Auth;
////////////////////////////////////////////////////

class LoginControllerTestOnLoginView extends Controller
{
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }

    ///////////////////////////// Begin Admin Methods ///////////////////////////////////

    ///////////////////////////// End Admin Methods ///////////////////////////////////
    /// ############################################################################## ///


    ///////////////////////////// Begin Customer Methods ///////////////////////////////////


    ///////////////////////////// End Customer Methods ///////////////////////////////////
    /// ############################################################################## ///
    ///
    /// //////////////////////  Begin MultiAuth Methods /////////////////////////////////////

    public function showLoginForm()
    {
        return view('auth.login', ['url' => 'multiAuth']);
    }

    public function MultiLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        } else {
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

                return redirect()->intended('/customer');
            }
            return back()->withInput($request->only('email', 'remember'));
        }
    }
    /////////////////////// End MultiAuth Methods /////////////////////////////////////
}
