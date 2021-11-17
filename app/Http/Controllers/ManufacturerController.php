<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManufacturerRequest;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\File;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function __construct(Manufacturer $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }
    public function index()
    {
        $manufacturers = $this->manufacturer::orderBy('created_at', 'asc')->get();
        // dd($manufacturers);
        return view('backend.manufacturer.index', compact('manufacturers'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.manufacturer.create');

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManufacturerRequest $request)
    {
        // dd($request->all());
        if (!is_dir('uploads'))
            mkdir('uploads');

        if (!is_dir('uploads/manufacturer'))
            mkdir('uploads/manufacturer');

        $this->manufacturer::create($request->createBrand());
        return redirect()->route('admin.manufacturer.index');
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
        $manufacturer = $this->manufacturer::find($id);
        // dd($manufacturer->manufacturer_description);
        return view('backend.manufacturer.edit', compact('manufacturer'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManufacturerRequest $request, $id)
    {
        $manufacturer = $this->manufacturer::find($id);
        // dd($manufacturer);


        $manufacturer->manufacturer_name = $request->manufacturer_name;
        $manufacturer->manufacturer_description = $request->manufacturer_description;

        if ($request->manufacturer_image != null) {
            $destination = public_path('/uploads/manufacturer/' . $manufacturer->manufacturer_image);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('manufacturer_image');
            $newImageName = time() . '_' . $file->getClientOriginalName();
            $dest = public_path('/uploads/manufacturer');
            $request->file('manufacturer_image')->move($dest, $newImageName);
            $manufacturer->manufacturer_image = $newImageName;
        }
        $manufacturer->manufacturer_image = $manufacturer->manufacturer_image;
        $manufacturer->update();
        return redirect()->route('admin.manufacturer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd('hrere');
        $manufacturer = $this->manufacturer::find($id);
        // dd($manufacturer);
        $destination = public_path('uploads/manufacturer/' . $manufacturer->manufacturer_image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $manufacturer->delete();
        return redirect()->back();
    }
}
