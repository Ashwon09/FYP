<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function details()
    {
        $user = Auth::user();
        return view('user.details', compact('user'));
    }

    public function updateDetails(Request $request)
    {
        $user = Auth::user();
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required','regex:/(9)[7-8]{1}[0-9]{8}/','max:10'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $values = [
                'name' => $request->name,
                'phone_number' => $request->phone_number,
            ];

            $query = $this->user::where('id', $user->id)->update($values);
            if ($query) {
                return response()->json(['status' => 1, 'msg' => 'Information Updated']);
            }
        }
    }

    public function passwordChangeForm()
    {
        return view('user.changepassword');
    }
    public function changePassword(PasswordRequest $request)
    {
          // dd($request->all());
          $oldPassword = $request->old_password;
          $newPassword = $request->new_password;
          $renewPassword = $request->password_confirmation;
  
          $userPassword = Auth::user()->password;
  
          if (Hash::check($oldPassword, $userPassword)) {
              if ($newPassword == $renewPassword) {
                  // dd('correct');
                  $user = $this->user::find(Auth::user()->id);
                  // dd($user);
                  $user->password = Hash::make($request->new_password);
                  $user->save();
                  return redirect()->back()->with('messageall', 'Your password changed successfully');
              } else {
                  return redirect()->back()->with('message', 'Your new password and re-enter password does not match');
              }
          } else {
              return redirect()->back()->with('message', 'Your Password is incorrect');
          }
    }
    
    public function deleteView(){
    $user=User::find(Auth::user()->id);
    return view('user.deleteUser', compact('user'));
    }

    public function deleteUser(Request $request)
    {
          // dd($request->all());
          $user = user::find(Auth::user()->id);
        // dd($request->name);

        if($request->name == $user->name){
            $user->delete();
            Auth::logout();
            return redirect()->route('home')->with('message','User Deleted');
        }
        else{
            // dd('false');
            return redirect()->back()->with('message','Invalid Input');

        }
  
        
    }

}
