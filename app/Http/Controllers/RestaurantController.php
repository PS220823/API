<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            //api/restaurants?sort={veld}
            if ($request->has('sort'))
            try {
                Log::channel('apilog')->info('GET Restaurants:', ['ip' => $request->ip(), 'time' => Carbon::now(), 'data' => Restaurant::all()]);
                return Restaurant::orderBy($request->sort)->get();
            }
            catch (\Throwable $th) {
                Log::channel('apilog')->error('GET Restaurants op soort faalde.', ['ip' => $request->ip(), 'time' => Carbon::now(), 'melding' => $th->getMessage()]);
            }

            //Elders
            else
            try {
                Log::channel('apilog')->info('GET Restaurants:', ['ip' => $request->ip(), 'time' => Carbon::now(), 'data' => Restaurant::all()]);
                return Restaurant::all();
            } catch (\Throwable $th) {
                Log::channel('apilog')->error('GET Restaurants faalde.', ['ip' => $request->ip(), 'time' => Carbon::now(), 'melding' => $th->getMessage()]);
            }
        
    }

    public function indexFunctie(Request $request, $id)
    {
        //api/soorten/{id}/restaurants?sort={veld}
        if ($request->has('sort'))
        try {
            Log::channel('apilog')->info("GET alle restaurants die bij soort {$id} horen (gesorteerd)", ['ip' => $request->ip(), 'time' => Carbon::now(), 'data' => Restaurant::where('soort_id',$id)->orderBy($request->sort)->get()]);
            return Restaurant::where('soort_id',$id)->orderBy($request->sort)->get();
        } catch (\Throwable $th) {
            Log::channel('apilog')->error("GET alle restaurants die bij soort {$id} op soort horen faalde" , ['ip' => $request->ip(), 'time' => Carbon::now(), 'melding' => $th->getMessage()]);
        }        
        //Elders
        else
        try {
            Log::channel('apilog')->info("GET alle restaurants die bij soort {$id} horen", ['ip' => $request->ip(), 'time' => Carbon::now(), 'data' => Restaurant::where('soort_id',$id)->get()]);
            return Restaurant::where('soort_id',$id)->get();
        } catch (\Throwable $th) {
            Log::channel('apilog')->error("GET alle restaurants die bij soort {$id} horen faalde" , ['ip' => $request->ip(), 'time' => Carbon::now(), 'melding' => $th->getMessage()]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $validator = Validator::make($request->all(), [
                'naam' => 'required',
                'soort_id' => 'required|integer',
                'eigenaar' => 'required',
                'plaats' => 'required',
                'oprichtingsdatum' => 'required|date'
            ]);
            if ($validator->fails()) {
                Log::channel('apilog')->error("POST restaurant gefaald", ['ip' => $request->ip(), 'time' => Carbon::now(), 'data' => $request->all()]);
                return response('{"Foutmelding":"Data niet correct"}', 400)
                       ->header('Content-Type','application/json');
    
            }
            else 
            {
                Log::channel('apilog')->info("POST restaurant", ['ip' => $request->ip(), 'time' => Carbon::now(), 'data' => $request->all()]);
                return Restaurant::create($request->all());    
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return $restaurant;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(), [
            'naam' => 'required',
            'soort_id' => 'required|integer',
            'eigenaar' => 'required',
            'plaats' => 'required',
            'oprichtingsdatum' => 'required|date'
        ]);
        if ($validator->fails()) {
            Log::channel('apilog')->error("PATCH restaurant gefaald", ['ip' => $request->ip(), 'time' => Carbon::now(), 'data' => $request->all()]);
            return response('{"Foutmelding":"Data niet correct"}', 400)
                   ->header('Content-Type','application/json');

        }
        else 
        {
            Log::channel('apilog')->info("PATCH restaurant", ['ip' => $request->ip(), 'time' => Carbon::now(), 'data' => $request->all()]);
            $restaurant->update($request->all()); 
            return $restaurant; 
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant, Request $request)
    {
        try {
            $restaurant->delete();
            Log::channel('apilog')->info("DEL restaurant" , ['ip' => $request->ip(), 'time' => Carbon::now(), 'restaurant' => $restaurant]);
        } catch (\Throwable $th) {
            Log::channel('apilog')->error("DEL restaurant faalde" , ['ip' => $request->ip(), 'time' => Carbon::now(), 'melding' => $th->getMessage()]);
        }
    }
}
