<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessValidRequest;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = Business::with('user')->where('user_id', Auth::id())->paginate(5);

        return view('businesses.index', compact('businesses'))
            ->with('i', ($businesses->currentPage() - 1) * $businesses->perPage() + 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('businesses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BusinessValidRequest $request)
    {
        Business::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('businesses.index')
            ->with('success', 'Business Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Business $business
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        $business = Business::with('locations')->findOrFail($business->id);
        return view('businesses.show', ['business' => $business]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Business $business
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        return view('businesses.edit', ['business' => $business]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Business $business)
    {
        $business->update($request->all());
        return redirect()->route('businesses.index')
            ->with('success', 'Business Updated Successfully');
//        $request->validated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Business $business
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Business $business)
    {
        $business->delete();
//        return redirect()->route('businesses.index')->with('success','Business Deleted Successfully');
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
