<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use RedirectsUsers, ThrottlesLogins;

    public function loginPage()
    {
        return view("user.auth.login");
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        // dd($request->all());

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email);
        if ($user->exists() && !$user->first()->hasRole('admin')) {
            return $this->guard()->attempt(
                $this->credentials($request),
                $request->filled('remember')
            );
        }
        Toastr::error('Enter Correct Credentials', 'Wrong Credentials');
        return false;
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('customer')) {
            Toastr::success('Welcome To Dashboard', 'Welcome');
            return redirect()->intended(route("customer.dashboard"));
        }

        if ($user->hasRole('company')) {
            Toastr::success('Welcome To Dashboard', 'Welcome');
            return redirect()->intended(route("company.dashboard"));
        }

        if ($user->hasRole('driver')) {
            Toastr::success('Welcome To Dashboard', 'Welcome');
            return redirect()->intended(route("driver.dashboard"));
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Toastr::success(
            'You Have Successfully Logged Out',
            'Logged Out'
        );
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function registerPage()
    {
        return view("user.auth.register");
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users",
            "usertype" => "required|numeric",
            "password" => "required|string|max:25|min:8|confirmed",
            "mobile_no" => "required|string|max:25",
        ]);
        $user = new User([
            "name" => $request->name,
            "email" => $request->email,
            "mobile_no" => $request->mobile_no,
            "password" => bcrypt($request->password),
        ]);
        if ($request->usertype == 1) {
            $user->assignRole('customer');
            $user->save();
        } else if ($request->usertype == 2) {
            $user->assignRole('company');
            $user->save();
        } else if ($request->usertype == 3) {
            $user->assignRole('driver');
            $user->save();
        } else {
            Toastr::error('Something Went Wrong', 'Error');
            return back();
        }
        Toastr::success("Successfully registered as " . $user->getRoleNames()->all()[0], 'Success');
        return back();
    }
}
