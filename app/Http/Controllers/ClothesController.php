<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clothes;

class ClothesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clothes = Clothes::all()->toArray();
        return array_reverse($clothes);
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
        //
        $clothes = new Clothes([
            'name' => $request->input('name'),
            'picture' => $request->input('picture'),
            'price' => $request->input('price'),
            'description' => $request->input('description')
        ]);
        $clothes->save();

        /// return message
        return response()->json('The Clothes was created');
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
        $clothes = Clothes::find($id);
        return response()->json($clothes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $clothes = Clothes::find($id);
        $clothes->update($request->all());

        return response()->json('The Clothes was updated');
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
        $clothes = Clothes::find($id);
        $clothes->delete();

        return response()->json('The Clothes was deleted');
    }
}
