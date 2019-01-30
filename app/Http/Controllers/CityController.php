<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
         $totals = DB::table('cities')
                     ->select('region')   
                   ->where(function ($query){
                       $query->where('region', '=', 'Klaipėda')
                        ->orWhere('region', '=' ,'Kretinga');
                   })
                    ->groupBy('region')
                    ->get();
        return view('cities.index', compact('cities','totals'));
          //->sum('population')   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create');//
    }
    public function hello(){
        echo "Hello worlk";
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
            'city'=>'required|unique:city|max:255',
            'region'=> 'required|max:255',
            'population' => 'required|integer'
          ]);
    
          

          City::create([
            'city' => $request['city'],
            'region' => $request['region'],
            'population' => $request['population']
          ]);
    
          return redirect('cities')->with('success', 'Miestas sukurtas');//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);

        return view('cities.show', compact('cities'));//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);

        return view('cities.edit', compact('city'));////
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
            'city'=>'required|max:255',
            'region'=> 'required|max:255',
            'population' => 'required|integer'
          ]);
    
          $city = City::find($id);
          $city->city = $request->get('city');
          $city->region = $request->get('region');
          $city->population = $request->get('population');
          $city->save();
    
          return redirect('/cities')->with('success', 'Miestas buvo atnaujintas');//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);

        $city->delete();
        return redirect('/')->with('success', 'Miestas buvo ištrintas');//

//
    }
}
