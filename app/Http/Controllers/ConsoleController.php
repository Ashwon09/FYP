<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsoleRequest;
use App\Models\Console;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(Console $console, Manufacturer $manufacturer)
    {
        $this->console = $console;
        $this->manufacturer = $manufacturer;

    }
    public function index()
    {
        $consoles=$this->console::orderBy('created_at','asc')->get();
        return view('backend.console.index', compact('consoles'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturers = $this->manufacturer::orderBy('manufacturer_name','asc')->get();
        return view('backend.console.create', compact('manufacturers'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsoleRequest $request)
    {
        // dd($request->all());
        $this->console::create($request->createConsole());
        return redirect()->route('admin.console.index');
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
        $manufacturers = $this->manufacturer::orderBy('manufacturer_name','asc')->get();

        $console=$this->console::find($id);
        return view('backend.console.edit', compact('console','manufacturers'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsoleRequest $request, $id)
    {
        $console=$this->console::find($id);
        $console->update($request->createCategory());
        return redirect()->route('admin.console.index');
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
        $console=$this->console::find($id);
        $console->delete();
        return redirect()->back();
        //
    }
}
