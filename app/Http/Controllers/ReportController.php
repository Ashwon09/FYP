<?php

namespace App\Http\Controllers;

use App\Models\report;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports= Report::orderBy('created_at', 'desc')->get();

        return view('backend.Reports.report', compact('reports'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // dd($request->all());
        $game = game::find($id);
        $game_id=$game->id;
        $user_id=Auth::user()->id;
        $report_reason=$request->report_reason;
        $report_comment="abcd";
        if ($request->report_reason == null){
            $report_comment="No Comment";
        }
        else{
            $report_comment=$request->report_reason;
        }
        $report_comment=$request->report_comment;
         report::create([
             'user_id'=> $user_id,
             'game_id' => $game_id,
             'report_reason' => $report_reason,
             'report_comment' => $report_comment,
         ]);
         return redirect()->back()->with('message', 'Game Reported!');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
