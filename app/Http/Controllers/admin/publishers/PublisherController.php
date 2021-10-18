<?php

namespace App\Http\Controllers\admin\publishers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Publisher;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::orderBy('id','desc')->get();
        return view('backend.pages.publishers.index',compact('publishers'));
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
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable|min:5',
            'address'     => 'required',
            'outlet'      => 'required',
        ]);

        $publisher = new Publisher();
        $publisher->name = $request->name;
        $publisher->link = $request->link;
        $publisher->description = $request->description;
        $publisher->address = $request->address;
        $publisher->outlet = $request->outlet;
        $publisher->save();

        return redirect()->route('publisher.index')->with('success','publishers has been added successfully!');
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
        $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable',
            'address' => 'nullable',
            'outlet' => 'nullable',
        ]);

        $publisher = Publisher::find($id);
        $publisher->name = $request->name;
        $publisher->link = $request->link;
        $publisher->description = $request->description;
        $publisher->outlet = $request->outlet;
        $publisher->address = $request->address;
        $publisher->save();

        return redirect()->route('publisher.index')->with('success','publishers has been added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publisher = Publisher::find($id);
        if(!is_null($publisher)){
            $publisher->delete();
        }
        return back()->with('success','Publisher has been deleted successfully!');
    }
}
