<?php

namespace App\Http\Controllers;

use App\Models\Connote;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function store(Request $request) {
        $customer_origin = Customer::find($request->customer_origin);
        $connote = Connote::find($request->connote_code);
        $location = Location::find($request->location_code);
        // return $connote;

        $store = Package::create([
            "customer_name" => "PT Amara Primartiga",
            "customer_code" => "1678593",
            "transaction_amount" => $request->transaction_value,
            "transaction_state" => "PAID",
            "transaction_code" => "CGKFT20200715121",
            "location_id" => $request->location_code,
            "customer_attribute" => [
                "sales_name" => "Radit Fitrawikarsa",
                "TOP" => "14 hari",
                "Jenis_Pelanggan" => "B2B"
            ],
            "connote" => [
                "connote_id" => $request->connote_id,
                "connote_service" => $connote->connote_service,
                "connote_amount" => $connote->connote_amount,
                "connote_code" => $connote->connote_code
            ],
            "origin_data" => [
                "customer_name" => $customer_origin->customer_name,
                "customer_address" => $customer_origin->customer_address
            ],
            "destination_data" => [
                "customer_name" => $customer_origin->customer_name,
                "customer_address" => $customer_origin->customer_address
            ],
            "koli_data" => "dummy_data",
            "custom_field" => [
                "catatan_tambahan" => "Frigile"
            ],
            "currentLocation" => [
                "name" => $location->name,
                "code" => $location->code,
                "type" => $location->type
            ]

        ]);

        return response()
        ->json(['message' => 'Simpan data berhasil', "result" => true]);
    }

    public function listPackage() {
        $data = Package::all();

        return response()
        ->json(['message' => 'get data berhasil', "result" => $data]);
    }
    public function updatePackage(Request $request,$id) {
        $customer_origin = Customer::find($request->customer_origin);
        $customer_destination = Customer::find($request->customer_destination);
        $connote = Connote::find($request->connote_code);
        $location = Location::find($request->location_code);


        $data = Package::where('_id',$id)->update([
            "customer_name" => "PT Amara Primartiga",
            "customer_code" => "1678593",
            "transaction_amount" => $request->transaction_value,
            "transaction_state" => "PAID",
            "transaction_code" => "CGKFT20200715121",
            "location_id" => $request->location_code,
            "customer_attribute" => [
                "sales_name" => "Radit Fitrawikarsa",
                "TOP" => "14 hari",
                "Jenis_Pelanggan" => "B2B"
            ],
            "connote" => [
                "connote_id" => $request->connote_id,
                "connote_service" => $connote->connote_service,
                "connote_amount" => $connote->connote_amount,
                "connote_code" => $connote->connote_code
            ],
            "origin_data" => [
                "customer_name" => $customer_origin->customer_name,
                "customer_address" => $customer_origin->customer_address
            ],
            "destination_data" => [
                "customer_name" => $customer_destination->customer_name,
                "customer_address" => $customer_destination->customer_address
            ],
            "koli_data" => "dummy_data",
            "custom_field" => [
                "catatan_tambahan" => "Frigile"
            ],
            "currentLocation" => [
                "name" => $location->name,
                "code" => $location->code,
                "type" => $location->type
            ]

        ]);



        return response()
        ->json(['message' => 'update data berhasil', "result" => $data]);
    }

    public function patchPackage(Request $request,$id) {



        $data = Package::where('_id',$id)->update([
            "customer_name" =>$request->customer_name

        ]);



        return response()
        ->json(['message' => 'patch data berhasil', "result" => $data]);
    }

    public function destroy($id) {
        $delete = Package::where('_id', $id)->delete();

        return response()
        ->json(['message' => 'delete data berhasil', "result" => null]);

    }
}
