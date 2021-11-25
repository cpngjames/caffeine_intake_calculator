<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::all()->toArray();
        return $drinks;
    }

    public function store(Request $request)
    {
        $drink = new Drink([
            'name' => $request->input('name'),
            'serving' => $request->input('serving'),
            'caffeine' => $request->input('caffeine'),
            'description' => $request->input('description')
        ]);
        $drink->save();

        return response()->json('Drink created successfully!');
    }

    public function show($id)
    {
        $drink = Drink::find($id);
        return response()->json($drinks);
    }

    public function update($id, Request $request)
    {
        $drink = Drink::find($id);
        $drink->update($request->all());

        return response()->json('Drink data updated successfully!');
    }

    public function destroy($id)
    {
        $drink = Drink::find($id);
        $drink->delete();

        return response()->json('Drink deleted successfully!');
    }

    public function calculate(Request $request)
    {
        $json = $request->json()->all();
        $total_intake = 0;
        $test = 0;

        foreach($json as $elem)  {
            $drink = Drink::find($elem['id']);
            $val = 0;
            $val = $drink->caffeine * $elem['amount'];
            $total_intake = $total_intake + $val;
        }

        if($total_intake > 500){

            return response()->json(array(
                'total_intake' => $total_intake,
                'exceed' => 0,
                'advice' => 'You drink enough'
            ));

        } else {

            $res = "";
            $sentences = [];
            $drinks = Drink::all();
            $spare = 500 - $total_intake;

            foreach($drinks as $drink)  {
                $stanard_drink = floor($spare/$drink->caffeine);
                array_push($sentences, "You can drink ".$drink->name." by ".$stanard_drink." more cup(s).");
                //$res = $res."You can drink ".$drink->name." by ".$stanard_drink." more cup(s). ";
            }

            return response()->json(array(
                'total_intake' => $total_intake,
                'exceed' => 1,
                'spare' => $spare,
                'advice' => $sentences
            ));
        }

    }
}
