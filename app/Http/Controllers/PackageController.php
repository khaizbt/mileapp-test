<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputPackageRequest;
use App\Http\Requests\PatchPackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Connote;
use App\Models\Customer;
use App\Models\KoliData;
use App\Models\Location;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function store(InputPackageRequest $request) {
        try {
            if($request->customer_origin == $request->customer_destination) {
                return response_error(null,"Customer Penerima dan Pengirim tidak boleh sama");
            }
            $customer_origin = Customer::find($request->customer_origin);
            $customer_destination = Customer::find($request->customer_destination);
            $connote = Connote::find($request->connote_code);
            $location = Location::find($request->location_code);
            // return $connote;

            $koli_data = [];
            for ($i = 0;$i <3;$i++) { //Save Dummy Data
                $koli_data[$i] = [
                    "koli_length" => 0,
                    "awb_url" =>  "https:\/\/tracking.mile.app\/label\/AWB00100209082020.".$i+1,
                    "created_at" => "2020-07-15 11:11:13",
                    "koli_chargeable_weight" => 9,
                    "koli_width" => 0,
                    "koli_surcharge" => [],
                    "koli_height" => 0,
                    "updated_at" => "2020-07-15 11:11:13",
                    "koli_description" => "V WARP",
                    "koli_formula_id" => null,
                    "connote_id" => $request->connote_code,
                    "koli_volume" => 0,
                    "koli_weight" => 9,
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.".$i+1
                ];
            }

            $save_koli = KoliData::insert($koli_data);


            $store = Package::create([
                "customer_name" => Auth::user()->name,
                "customer_code" => Auth::id(),
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
                "koli_data" => $koli_data, //TODO buat koli array dari location_id(buat document koli
                "custom_field" => [
                    "catatan_tambahan" => "Frigile"
                ],
                "currentLocation" => [
                    "name" => $location->name,
                    "code" => $location->code,
                    "type" => $location->type
                ]

            ]);

        return response_success(null, "Simpan Data Berhasil");
        } catch (\Exception $err) {
            return response_error(null, $err->getMessage(), 402);
        }
    }

    public function listPackage() {
        try {
            $data = Package::all();

            return response_success($data, "Get Data Berhasil");
        } catch (\Exception $err) {
            return response_error(null, $err->getMessage());
        }
    }

    public function detailPackage($id) {
        try {
            $data = Package::find($id);

            return response_success($data, "Get Detail Data Berhasil");
        } catch (\Exception $err) {
            return response_error(null, $err->getMessage());
        }
    }

    public function updatePackage(UpdatePackageRequest $request,$id) { //Jika Update maka semuanya diupdate
        try {
            if($request->customer_origin == $request->customer_destination) {
                return response_error(null,"Customer Penerima dan Pengirim tidak boleh sama");
            }



            $customer_origin = Customer::find($request->customer_origin);
            $customer_destination = Customer::where('_id',$request->customer_destination)->first();
            $connote = Connote::find($request->connote_code);
            $location = Location::find($request->location_code);

            $data = Package::where('_id',$id)->first();
            if(!$data) {
                return response_error(null, "Data tidak valid");
            }
            $update= $data->update([
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
                    "customer_address" => $customer_origin->address,
                    "customer_address_detail" => $customer_origin->address_detail,
                    "customer_zip_code" => $customer_origin->zip_code

                ],
                "destination_data" => [
                    "customer_name" => $customer_destination->customer_name,
                    "customer_address" => $customer_destination->address,
                    "customer_address_detail" => $customer_destination->address_detail,
                    "customer_zip_code" => $customer_destination->zip_code
                ],

                "custom_field" => [
                    "catatan_tambahan" => "Frigile"
                ],
                "currentLocation" => [
                    "name" => $location->name,
                    "code" => $location->code,
                    "type" => $location->type
                ]

            ]);

            return response_success(null, "Update Data Sukses");
        } catch (\Exception $err) {
            return response_error(null, $err->getMessage());
        }
    }

    public function patchPackage(PatchPackageRequest $request,$id) { // Jika patch hanya kolom yang dikirimkan yang diupdate
        try {
            $data = Package::where('_id',$id)->first();
            if(!$data) {
                return response_error(null, "Data tidak valid");
            }
            $patch = $data->update([
                "transaction_code" =>$request->transaction_code

            ]);

            return response_success(null, "Patch Data Sukses");
        } catch (\Exception $err) {
            return response_error(null, $err->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $data = Package::where('_id', $id)->first();

            if(!$data) {
                return response_error(null, "Data tidak valid");
            }

            $data->delete();

            return response_success(null, "Delete Data Sukses");

        } catch (\Exception $err) {
            return response_error(null, $err->getMessage());
        }
    }
}
