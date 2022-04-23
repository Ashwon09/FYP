<?php

namespace App\Http\Controllers;

use App\Mail\deleteGame;
use App\Models\Game;
use App\Models\Manufacturer;
use App\Models\Console;
use App\Models\User;
use App\Models\user_report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //
    public function __construct(Manufacturer $manufacturer, Game $games, Console $console)
    {
        $this->manufacturer=$manufacturer;
        $this->game=$games;
        $this->console=$console;
    }

    public function index()
    {
        $soldgames= $this->game::where('game_status','sold')->get();
        $users= User::get();
        $games= $this->game::get();
        return view('backend.index', compact('soldgames','users','games'));
    }

    public function destroy($id)
    {
        $game = $this->game::find($id);
        $user_id= $game->user_id;
        // dd($user_id); 
        $this->user_report($user_id);
        $destination = public_path('uploads/game/' . $game->game_image);
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $data=[
            'game'=>$game->game_name,       
        ];
        // dd($game->user->email);
        Mail::to($game->user->email)->send(new deleteGame($data));
        $game->delete();
        return redirect()->route('admin.reportIndex');
        //
    }

    public function user_report($id){
        $reports= user_report::where('user_id',$id)->first();
        if(empty($reports)){
            user_report::create([
                'user_id'=> $id,
                'report_times' => 1,
            ]);
        }
        else{
            $reports->report_times = $reports->report_times + 1; 
            $reports->update();
        }

    } 

    public function viewBannedUsers(){
        $users=User::where('role','banned')->get();
        return view('backend.Reports.bannedUsers', compact('users'));

    }
    public function banUser($id){
        // dd('here');
        $user=User::find($id);
        // dd($user);
         $user->role = 'banned';
         $user->update();
         return redirect()->back();
    }

    public function unBanUser($id){
        $user=User::find($id);
         $user->role = 'customer';
         $user->update();
         return redirect()->back();

    }


}
