<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use Illuminate\Support\Facades\Validator;

class AddressesController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->get('search');

        $addresses = Address::where('surname', 'like', "%{$data}%")
                    ->orWhere('phone', 'like', "%{$data}%")

                    ->paginate(15);

        if ($addresses->count()) {
            return response()->json([
                'data' => $addresses
            ], 200);
        } else {
            return response()->json([
                'message' => 'No addresses found'
            ], 204);
        }
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
                'message' => "Address has been added"
            ], 201);
        }
    }
}
