<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Contracts\Bus\Dispatcher;
use Symfony\Component\Console\Output\ConsoleOutput;
use Mail;
use App\Mail\EmailVerification;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/welcome';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest');
        //responseData();
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
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'city' => 'required|string',
            'country' => 'required|string',
            'username' => 'required|string|max:255',
        ]);
    }

    //check request data and response
    public function responseData(Request $request){
        if( validator($request->all())->fails() )
        {

        }
        else return redirect('/register')->withInput($request->except(validator($request->all())->invalid()));
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'city' => $data['city'],
            'country' => $data['country'],
            'username' => $data['username'],
            'email_token' => base64_encode($data['email'])
        ]);
    }
    public function register(Request $request)
    {
      $this->validator($request->all())->validate();
      event(new Registered($user = $this->create($request->all())));

      //dispatch(new SendVerificationEmail($user));
      $email = new EmailVerification($user);
      $value = Mail::to($user->email)->send($email);
      echo $value;
      return view('verification');
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        if( User::where('email', '=', $user->email)->count() > 0 )
        {
            Auth::login(User::where('email', '=', $user->email)->first(), true);
            return redirect()->route('home',['field'=>'email', 'value'=>$user->email]);
        }
        $newUser = $this->findOrCreateUser($user);

        Auth::login($newUser, true);
        return Redirect::to('home',['field'=>'email', 'value'=>$user->email]);
    }
    private function findOrCreateUser($user)
    {
        if ($user = User::where('email', $user->email)->first()) {
            return $user;
        }

        $newUser = new User;
        $newUser->fullname = $user->name;
        $newUser->username = $user->nickname = '' ? $user->nickname : $user->name;
        $newUser->email = $user->email;
        $newUser->city = '';
        $newUser->country = '';
        $newUser->password = '';
        $newUser->email_token = '';

        return $newUser;
    }
    public function verify($token)
    {
      return redirect()->route('home',['field'=>'email_token', 'value'=>$token]);
      /*$user = User::where('email_token',$token)->first();

      if($user->save())
        return view('home',['user'=>$user]);*/
    }
}
