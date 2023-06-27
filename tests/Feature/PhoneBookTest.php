<?php

namespace Tests\Feature;

use App\Models\PhoneBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhoneBookTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex()
    {
        $phoneBook1 = PhoneBook::factory()->create();
        $phoneBook2 = PhoneBook::factory()->create();

        $response = $this->get(route('api.phoneBook.index'));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'identify'   => $phoneBook1->id,
                        'name' => $phoneBook1->name,
                        'DDD'  => $phoneBook1->DDD,
                        'city' => $phoneBook1->city,
                    ],
                    [
                        'identify'   => $phoneBook2->id,
                        'name' => $phoneBook2->name,
                        'DDD'  => $phoneBook2->DDD,
                        'city' => $phoneBook2->city,
                    ],
                ]
        ]);
    }
    
    public function testStore()
    {
        $data = [
            'DDD'  => 12,
            'name' => 'John Doe',
            'city' => 'Sample City',
        ];

        $response = $this->post(route('api.phoneBook.store'), $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('phone_books', $data);
    }

    public function testUpdate()
    {
        $phoneBook = PhoneBook::factory()->create();

        $data = [
            'DDD'  => 34,
            'name' => 'Jane Smith',
            'city' => 'Updated City',
        ];

        $response = $this->put(route('api.phoneBook.update', ['id' => $phoneBook->id]), $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('phone_books', $data);
    }

    public function testDestroy()
    {
        $phoneBook = PhoneBook::factory()->create();

        $response = $this->delete(route('api.phoneBook.destroy', ['id' => $phoneBook->id]));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('phone_books', ['id' => $phoneBook->id]);
    }

    public function testValidationErrors()
    {
        $data = [
            'DDD'  => 'invalid',
            'name' => '',
            'city' => '',
        ];

        $response = $this->post(route('api.phoneBook.store'), $data);

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'message' => 'Erro de validação',
                'data'  => [
                    'DDD' => [
                        'O campo DDD deve ser um número.',
                        'O campo DDD deve ter  2 dígitos.',
                    ],
                    'name' => [
                        'O campo nome é obrigatório.',
                    ],
                    'city' => [
                        'O campo cidade é obrigatório.',
                    ],
                ],
            ]);
    }
}


