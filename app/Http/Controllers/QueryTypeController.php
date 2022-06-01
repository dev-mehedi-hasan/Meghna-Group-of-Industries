<?php

namespace App\Http\Controllers;

use App\Http\Requests\QueryTypeFormValidation;
use Illuminate\Http\Request;
use App\Models\QueryType;
use Illuminate\Support\Facades\Input;
use Alert;
use Validator;

class QueryTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query_types = QueryType::get();
        return view('query_types.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('query_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QueryTypeFormValidation $request)
    {
        $query_type = new QueryType;
        $this->dataStore($query_type,$request);

        Alert::success('Success', 'Successfully Created');

        return redirect('query-type');

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
        $query_type = QueryType::find($id);

        return view('query_types.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QueryTypeFormValidation $request, $id)
    {
        $query_type = QueryType::find($id);
        $this->dataStore($query_type,$request);

        Alert::success('Success', 'Successfully Updated');

        return redirect('query-type');
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
            QueryType::find($id)->delete();
            return back()->with('success', 'Successfully Deleted!');

        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }

    protected function dataStore($query_type,$request)
    {
        $query_type->name = $request->name;
        $query_type->save();
    }
}
