<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $locations = location::with(['user','business'])->where('user_id',Auth::id())->paginate(5);

        return view('locations.index',compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $business = Business::all();
        return view('locations.create',['businesses'=>$business]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required',
            'email'=>'required',
        ]);

        location::create([
                 'name' => $request->name,
                'email' => $request->email,
                'business_id' => $request->business_id,
                'user_id' => Auth::id(),
                ]);
        return redirect()->route('locations.index')->with('success','location created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\location  $location
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(location $location)
    {
        return view('locations.show',['locations'=>$location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\location  $location
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(location $location)
    {
        $business = Business::all();
        return view('locations.edit',compact(['location','business']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\location  $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, location $location)
    {
        $location->update($request->all());
        return redirect()->route('locations.index')
            ->with('success','location Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\location  $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(location $location)
    {
        $location->delete();
        return back()->with('success','Deleted Successfully');
    }
}
