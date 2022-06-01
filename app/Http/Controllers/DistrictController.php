<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistrictFormValidation;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;
use Validator;
Use Alert;
use Illuminate\Support\Facades\Input;

class DistrictController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $districts = District::with('division')->get();

        return view('districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('districts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictFormValidation $request)
    {
        $district = new District;
        $this->dataStore($district, $request);

        Alert::success('Success', 'Successfully Created');

        return redirect('district');
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
    public function edit(District $district)
    {
        return view('districts.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictFormValidation $request, $id)
    {
        $district = District::find($id);
        $this->dataStore($district, $request);

        Alert::success('Success', 'Successfully updated');
        return redirect('district');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            District::find($id)->delete();
            return back()->with('success', 'Successfully Deleted!');
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }

    protected function dataStore($district, $request)
    {
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->save();
    }
}
