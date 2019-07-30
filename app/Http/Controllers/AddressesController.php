<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use Illuminate\Support\Facades\Validator;

class AddressesController extends Controller
{

    public function index()
    {
        $addresses = Address::all();
        return $addresses;
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'surname' => 'required|string',
            'phone' => 'required|string',
        ]);

        if ($data->fails()) {
            return response()->json([
                'message' => $data->errors()
            ], 400);
        } else {
            $address = new Address();
            $address->surname = $request->surname;
            $address->phone = $request->phone;
            $address->save();

            return response()->json([
                'message' => "address has been added"
            ], 201);
        }
    }

}
