<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;


class AuthController extends Controller
{
    public function showSuccess(Request $request)
    {
        $user = Auth::guard()->user();
        $sessions = DB::table('sessions')->get();
//        dd($sessions);
        return view('success', compact('user', 'sessions'));
    }

    public function checkLogin(LoginRequest $request)
    {
        $auth = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $rememberme = $request->rememberme == 'on';
        if (Auth::attempt($auth, $rememberme)) {
            $request->session()->regenerate();
            $userId = Auth::guard()->user();
            $sessions = DB::table('sessions')->get()->toArray();
//            dd($sessions);
            if ($sessions == null) {
                $ip = new \App\Models\Session();
                $ip->id = Str::random(10);
                $ip->user_id = $userId->id;
                $ip->ip_address = geoip()->getClientIP();
                $ip->save();
            } else {
                foreach ($sessions as $val) {
                    if ($val->user_id !== $userId->id) {
                        $ip = new \App\Models\Session();
                        $ip->id = Str::random(10);
                        $ip->user_id = $userId->id;
                        $ip->ip_address = geoip()->getClientIP();
                        $ip->save();

                    } else {
                        dd('bạn đang đăng nhập tại một địa chỉ khác');
                    }
                }
            }
            return redirect()->route('login_success');
        } else {
            Session::flash('error', 'User name or password is incorrect');
            return redirect()->route('show_login');
        }
    }

    public function logout(Request $request)
    {

        $user = Auth::guard()->user();
        $session = \App\Models\Session::where('user_id',$user->id)->first();
        $session->delete();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('show_login');
    }
}
