<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function can_add_address()
    {
        $address = ['surname' => 'Nowakowski', 'phone' => '43534 54545 5322'];
        $this->json('post', '/api/addresses', $address)
            ->assertStatus(201)
            ->assertJson(
                [
                    'message' => "Address has been added",
                ]
            );
        $this->assertDatabaseHas(
            'addresses',
            [
                'surname' => 'Nowakowski',
                'phone' => '43534 54545 5322',
            ]
        );
    }

    /**
     * @test
     * @return void
     */
    public function require_surname_and_phone_on_new_address()
    {
        $address = [];
        $this->json('post', '/api/addresses', $address)
            ->assertStatus(400)
            ->assertJson(
                [
                    'message' => [
                        "surname" => ["The surname field is required."],
                        "phone" => ["The phone field is required."],
                    ],
                ]
            );
    }

    /**
     * @test
     * @return void
     */
    public function can_get_no_addresses_status_if_table_empty()
    {
        $this->json('get', '/api/addresses')
            ->assertStatus(204);
    }

    /**
     * @test
     * @return void
     */
    public function can_get_address_list_with_correct_search()
    {

        $address = ['surname' => 'Nowakowski', 'phone' => '43534 54545 5322'];
        $this->json('post', '/api/addresses', $address);
        $address = ['surname' => 'Kowalski', 'phone' => '8907 389 3233'];
        $this->json('post', '/api/addresses', $address);

        $this->json('get', '/api/addresses')
            ->assertStatus(200);
        $this->json('get', '/api/addresses', ['search' => ''])
            ->assertStatus(200)
            ->assertJsonCount(2, 'data.data.*');
        $this->json('get', '/api/addresses', ['search' => 'kowa'])
            ->assertStatus(200)
            ->assertJsonCount(1, 'data.data.*');
    }
}
