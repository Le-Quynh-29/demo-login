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
//        if($request->session()->has('sessions.user_id')){
//            echo $request->session()->get('sessions.user_id').' & '.$request->session()->get('sessions.ip_address');
//        } else {
//            echo 'No data';
//        }
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
            $sessions = DB::table('sessions')->get();
            dd($sessions);
            if ($sessions !== null) {
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
            } else {
                $ip = new \App\Models\Session();
                $ip->id = Str::random(10);
                $ip->user_id = $userId->id;
                $ip->ip_address = geoip()->getClientIP();
                $ip->save();
            }
//            if($request->session()->exists(['sessions.user_id','sessions.ip_address'])){
//
//                $this->logout();
//            } else {

//                $request->session()->put('sessions.user_id', $userId->id);
//                $request->session()->put('sessions.ip_address', geoip()->getClientIP());
//            }
//

//            }
            return redirect()->route('login_success');
        } else {
            Session::flash('error', 'User name or password is incorrect');
            return redirect()->route('show_login');
        }
    }

    public function logout(Request $request, $id)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $session = \App\Models\Session::find($id);
        $session->delete();
//        $request->session()->forget('sessions.user_id');
//        $request->session()->forget('sessions.ip_address');
        return redirect()->route('show_login');
    }
}
