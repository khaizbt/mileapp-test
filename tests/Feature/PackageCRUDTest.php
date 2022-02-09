<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PackageCRUDTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateMustEnterRequiredData()
    {
        $token = "Bearer 62037801d8100000ed003975|DY0wiJ0tFEC09B5PA9m1bkDHqF5krKXrskmfvZKc"; //Token didapatkan dari Auth, anda harus login terlebih dahulu untuk mendapatkan token
        $this->withHeaders(['Authorization' =>  $token])->json('POST', 'api/v1/package')
            ->assertStatus(422)
            ->assertJson([
                "status" => false,
                "message" => [
                    "customer_origin" => ["The Customer Pengirim field is required."],
                    "customer_destination" => [
                        "The Customer Penerima field is required."
                    ],
                    "transsaction_value"=> [
                        "The Biaya Pengiriman field is required."
                    ],
                    "location_code" => [
                        "The Lokasi field is required."
                    ],
                    "connote_code" => [
                        "The Connote field is required."
                    ]
                ],
                "result" => null
            ]);
    }

    public function testCreateMustLogin()
    {
        $this->json('POST', 'api/v1/package')
            ->assertStatus(401)
            ->assertJson([
                "error" => "Unauthenticated.",

            ]);
    }
    // public function testSuccessfulCreate()
    // {
    //     $token = "Bearer 62037801d8100000ed003975|DY0wiJ0tFEC09B5PA9m1bkDHqF5krKXrskmfvZKc"; //Token didapatkan dari Auth, anda harus login terlebih dahulu untuk mendapatkan token
    //     $data = ['customer_origin' => '62027b5446f7a9ce0e4e1f3c',
    //             'customer_destination' => '62028f8746f7a9ce0e4e1f53',
    //             "transsaction_value" => "80000",
    //         "location_code" => "62027bf746f7a9ce0e4e1f3f",
    //     "connote_code" => "6202895f46f7a9ce0e4e1f48"];

    //     $this->withHeaders(['Authorization' =>  $token])->json('POST', 'api/v1/package', $data, ['Accept' => 'application/json'])
    //         ->assertStatus(200)
    //         ->assertJsonStructure([
    //             "status",
    //             "message",
    //             'result'
    //         ]);

    //     $this->assertAuthenticated();
    // }

    public function testUpdateMustEnterRequiredData()
    {
        $package_id = "62028a39495600001c004676";
        $token = "Bearer 62037801d8100000ed003975|DY0wiJ0tFEC09B5PA9m1bkDHqF5krKXrskmfvZKc"; //Token didapatkan dari Auth, anda harus login terlebih dahulu untuk mendapatkan token
        $this->withHeaders(['Authorization' =>  $token])->json('PUT', 'api/v1/package/'.$package_id)
            ->assertStatus(422)
            ->assertJson([
                "status" => false,
                "message" => [
                    "customer_origin" => ["The Customer Pengirim field is required."],
                    "customer_destination" => [
                        "The Customer Penerima field is required."
                    ],
                    "transsaction_value"=> [
                        "The Biaya Pengiriman field is required."
                    ],
                    "location_code" => [
                        "The Lokasi field is required."
                    ],
                    "connote_code" => [
                        "The Connote field is required."
                    ]
                ],
                "result" => null
            ]);
    }

    public function testMethodNotAllowed() //Update with POST Method
    {
        $package_id = "62028a39495600001c004676";
        $token = "Bearer 62037801d8100000ed003975|DY0wiJ0tFEC09B5PA9m1bkDHqF5krKXrskmfvZKc"; //Token didapatkan dari Auth, anda harus login terlebih dahulu untuk mendapatkan token
        $this->withHeaders(['Authorization' =>  $token])->json('POST', 'api/v1/package/'.$package_id)
            ->assertStatus(405);
    }

    // public function testSuccessfulUpdate()
    // {
    //     $package_id = "62028a39495600001c004676";
    //     $token = "Bearer 62037801d8100000ed003975|DY0wiJ0tFEC09B5PA9m1bkDHqF5krKXrskmfvZKc"; //Token didapatkan dari Auth, anda harus login terlebih dahulu untuk mendapatkan token
    //     $data = ['customer_origin' => '62027b5446f7a9ce0e4e1f3c',
    //             'customer_destination' => '62028f8746f7a9ce0e4e1f53',
    //             "transsaction_value" => "50000",
    //         "location_code" => "62027bf746f7a9ce0e4e1f3f",
    //     "connote_code" => "6202895f46f7a9ce0e4e1f48"];

    //     $this->withHeaders(['Authorization' =>  $token])->json('PUT', 'api/v1/package/'.$package_id, $data, ['Accept' => 'application/json'])
    //         ->assertStatus(200)
    //         ->assertJsonStructure([
    //             "status",
    //             "message",
    //             'result'
    //         ]);

    //     $this->assertAuthenticated();
    // }

    public function testGetListData()
    {
        $package_id = "62028a39495600001c004676";
        $token = "Bearer 62037801d8100000ed003975|DY0wiJ0tFEC09B5PA9m1bkDHqF5krKXrskmfvZKc"; //Token didapatkan dari Auth, anda harus login terlebih dahulu untuk mendapatkan token
        $this->withHeaders(['Authorization' =>  $token])->json('GET', 'api/v1/package/'.$package_id, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                'result'
            ]);

        $this->assertAuthenticated();
    }

    public function testGetDetailData()
    {
        $token = "Bearer 62037801d8100000ed003975|DY0wiJ0tFEC09B5PA9m1bkDHqF5krKXrskmfvZKc"; //Token didapatkan dari Auth, anda harus login terlebih dahulu untuk mendapatkan token
        $this->withHeaders(['Authorization' =>  $token])->json('GET', 'api/v1/package', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                'result'
            ]);

        $this->assertAuthenticated();
    }
    public function testPatchData()
    {
        $package_id = "62028a39495600001c004676";

        $data = ["transaction_code" => "AWB00131731110"];
        $token = "Bearer 62037801d8100000ed003975|DY0wiJ0tFEC09B5PA9m1bkDHqF5krKXrskmfvZKc"; //Token didapatkan dari Auth, anda harus login terlebih dahulu untuk mendapatkan token
        $this->withHeaders(['Authorization' =>  $token])->json('PATCH', 'api/v1/package/'.$package_id,$data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                'result'
            ]);

        $this->assertAuthenticated();
    }
    public function testDeleteData()
    {
        $package_id = "620379cc382f000004003ba6";


        $token = "Bearer 62037801d8100000ed003975|DY0wiJ0tFEC09B5PA9m1bkDHqF5krKXrskmfvZKc"; //Token didapatkan dari Auth, anda harus login terlebih dahulu untuk mendapatkan token
        $this->withHeaders(['Authorization' =>  $token])->json("DELETE", 'api/v1/package/'.$package_id, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                'result'
            ]);

        $this->assertAuthenticated();
    }
}
