<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Error create new Client.
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {
        $payload = [
            'name' => 'Darcio Fernandes',
            'email' => 'darciofjunior81@gmail.com',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422);
                    // ->assertExactJson([
                    //     'message' => 'The given data was invalid.',
                    //     'errors' => [
                    //         'password' => [trans('validation.required', ['attribute' => 'password'])]
                    //     ]
                    // ]);
    }

    /**
     * Success create new Client.
     *
     * @return void
     */
    public function testSuccessCreateNewClient()
    {
        $payload = [
            'name' => 'DJR Recuperação de Dados',
            'email' => 'recuperadadosdjr@gmail.com',
            'password' => 'Dr178264'
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(201)
                    ->assertExactJson([
                        'data' => [
                            'name' => $payload['name'],
                            'email' => $payload['email'],
                        ]
                    ]);
    }
}
