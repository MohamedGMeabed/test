<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        if($user->attempts ==3)
        {
            $seconds = (time() - strtotime($user->updated_at) ) ;
            if($seconds < 30 && $seconds > 0){
                return back()->with('timer', $seconds);
            }
        }
        elseif($user->attempts == 4)
        {
            return back()->with('locked','Your Account Are Locked Please Contact With Your Admin');
        }
        
        if(Hash::check($request->password, $user->password) === false)
        {
            $user->update(['attempts'=> $user->attempts + 1]);

            if($user->attempts ==3)
            {
                return back()->with('timer', 30);
            }
            elseif($user->attempts == 4)
            {
                return back()->with('locked','Your Account Are Locked Please Contact With Your Admin');
            }
        }

        if (auth()->guard('web')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")]))
         {
            $user->update(['attempts'=> $user->attempts = 0]);
            return redirect(url('/home'))->with('success' , 'logged In Successfully');
        }
    }
    
}
