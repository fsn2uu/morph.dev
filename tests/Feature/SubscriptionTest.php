<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Generator;
use Faker\Factory;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_guest_can_register()
    {
        $faker = Factory::create();
        $response = $this->post('signup', [
            "_token" => csrf_token(),
            "plan" => "enterprise",
            "additional_neighborhoods" => null,
            "additional_units" => null,
            "fname" => $faker->firstName,
            "lname" => $faker->lastName,
            "email" => $faker->safeEmail,
            "phone" => $faker->phoneNumber,
            "phone2" => null,
            "password" => "SomeGenericPassword",
            "password_confirmation" => "SomeGenericPassword",
            "id_number" => 3214,
            "dob_day" => 25,
            "dob_month" => 04,
            "dob_year" => 1978,
            "name" => "Testermans Rentals",
            "address" => "234 Main St",
            "address2" => null,
            "city" => "Panama City",
            "state" => "FL",
            "zip" => 32401,
            "website" => "https://www.cysy.com",
            "company_phone" => $faker->phoneNumber,
            "company_phone2" => null,
            "toll_free" => null,
            "number" => 424242424242424,
            "exp_year" => 2023,
            "exp_month" => 2,
            "cvc" => 123,
            "account_holder" => "Testerman Test",
            "account_number" => '000999999991',
            "routing_number" => 110000000,
            "accepted_terms" => 1,
            "acknowledged_legality" => 1,
        ]);

        $response->assertStatus(302);
    }
}
