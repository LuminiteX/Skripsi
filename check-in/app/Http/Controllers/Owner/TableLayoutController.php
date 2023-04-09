<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TableLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TableLayoutRequest;

class TableLayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = Auth::user()->restaurant;
        $table_layouts = TableLayout::where('restaurant_id', $restaurant->id)
                                    ->orderBy('floor_number', 'asc')
                                    ->get();
        return view('owner.table_layout.index', compact('table_layouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = Auth::user()->restaurant;
        $restaurant_id = $restaurant->id;
        $table_layouts = TableLayout::where('restaurant_id', $restaurant->id)->get();
        return view('owner.table_layout.create', compact('table_layouts','restaurant_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableLayoutRequest $request)
    {
        $image = $request->file('image')->store('public/table_layouts');
        TableLayout::create([
            'restaurant_id' => $request->restaurant_id,
            'floor_number' => $request->floor_number,
            'floor_name' => $request->floor_name,
            'floor_image' => $image
        ]);

        return to_route('owner.table_layouts.index')->with('success', 'Table layout created successfully.');
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
    public function edit(TableLayout $table_layout)
    {

        return view('owner.table_layout.edit', compact('table_layout'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TableLayout $table_layout)
    {
        $request->validate([
            'floor_number' => ['required','integer'],
            'floor_name' => ['required'],
            'image' => ['image'],
        ]);

        $image = $table_layout->image;
        if ($request->hasFile('image')) {
            Storage::delete($table_layout->image);
            $image = $request->file('image')->store('public/categories');
        }

        $table_layout->update([
            'floor_number' => $request->floor_number,
            'floor_name' => $request->floor_name,
            'image' => $image
        ]);
        return to_route('owner.table_layouts.index')->with('success', 'Table layout updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableLayout $table_layout)
    {
        // dd($table_layout);
        Storage::delete($table_layout->floor_image);
        $table_layout->delete();

        return to_route('owner.table_layouts.index')->with('danger', 'Table layout deleted successfully.');
    }
}
