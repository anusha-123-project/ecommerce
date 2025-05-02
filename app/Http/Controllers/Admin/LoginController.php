<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function create()
    {
        return view('admin.login');
    }
    public function logincheck(Request $request)
   {
       $validator=validator::make($request->all(),[
           'username'=>'required|email',
           'password'=>'required'

       ]);
       if($validator->passes())
       {
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password], $request->remember)) {
           return redirect()->intended('admin-dashboard');
        }
         else
         {
           return redirect('admin-login')->with('error','invalid email or password');
         }
       }
       else
       {
         return redirect('admin-login')->withErrors($validator);

       }
   }
   public function dashboard()
   {
    return view('admin.dashboard');
   }
}
