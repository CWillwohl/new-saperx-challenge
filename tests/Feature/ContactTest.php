<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\PhoneBook;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex()
    {
        $phoneBook = PhoneBook::factory()->create();

        $data = [
            'phone_book_id' => $phoneBook->id,
            'birthday'      => now()->format('Y-m-d'),
            'email'         => "test@email.com",
            'phone'         => "15999994444",
            'name'          => "Rubio da Costa",
            'cpf'           => "11122233345",
        ];

        $contact = Contact::create($data);

        $response = $this->get(route('api.contact.index', $phoneBook->id));

        $response->assertStatus(200)
                    ->assertJson([
                        'data' => [
                            [
                                'phoneBook' => [
                                    'identify'   => $phoneBook->id,
                                    'name'       => $phoneBook->name,
                                    'DDD'        => $phoneBook->DDD,
                                    'city'       => $phoneBook->city,
                                ],
                                'birthday'      => $contact->birthday,
                                'email'         => $contact->email,
                                'phone'         => $contact->phone,
                                'name'          => $contact->name,
                                'cpf'           => $contact->cpf,
                            ],
                        ],
                ]);
    }

    public function testStore()
    {
        $phoneBook = PhoneBook::factory()->create();

        $data = [
            'phone_book_id' => $phoneBook->id,
            'birthday'      => now()->format('Y-m-d'),
            'email'         => "test@email.com",
            'phone'         => "15999994444",
            'name'          => "Rubio da Costa",
            'cpf'           => "11122233345",
        ];

        $response = $this->post(route('api.contact.store', $phoneBook->id), $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('contacts', $data);
    }

    public function testUpdate()
    {
        $phoneBook = PhoneBook::factory()->create();

        $data = [
            'phone_book_id' => $phoneBook->id,
            'birthday'      => now()->format('Y-m-d'),
            'email'         => "test@email.com",
            'phone'         => "15999994444",
            'name'          => "Rubio da Costa",
            'cpf'           => "11122233345",
        ];

        $contact = Contact::create($data);

        $newData = [
            'birthday'      => now()->format('Y-m-d'),
            'email'         => "test2@email.com",
            'phone'         => "15555554444",
            'name'          => "Andre Ricardo",
            'cpf'           => "99988877766",
        ];

        $response = $this->put(route('api.contact.update', [$phoneBook->id, $contact->id]), $newData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('contacts', $newData);
    }

    public function testDestroy()
    {
        $phoneBook = PhoneBook::factory()->create();

        $data = [
            'phone_book_id' => $phoneBook->id,
            'birthday'      => now()->format('Y-m-d'),
            'email'         => "test@email.com",
            'phone'         => "15999994444",
            'name'          => "Rubio da Costa",
            'cpf'           => "11122233345",
        ];

        $contact = Contact::create($data);

        $response = $this->delete(route('api.contact.destroy', [$phoneBook->id, $contact->id]));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    public function testValidationErrors()
    {
        $phoneBook = PhoneBook::factory()->create();

        $data = [
            'phone_book_id' => '',
            'birthday'      => '',
            'email'         => '',
            'phone'         => '',
            'name'          => '',
            'cpf'           => '',
        ];

        $response = $this->post(route('api.contact.store', $phoneBook->id), $data);


        $response->assertStatus(422)
        ->assertJson([
            'success' => false,
            'message' => 'Erro de validação',
            'data'  => [
                'phone_book_id' => [
                    'O campo phone book id é obrigatório.',
                ],
                'birthday' => [
                    'O campo data de nascimento é obrigatório.',
                ],
                'email' => [
                    'O campo e-mail é obrigatório.',
                ],
                'phone' => [
                    'O campo telefone é obrigatório.',
                ],
                'name' => [
                    'O campo nome é obrigatório.',
                ],
                'cpf' => [
                    'O campo CPF é obrigatório.',
                ],
            ],
        ]);
    }

    public function testValidationWithAnotherErrors()
    {
        $phoneBook = PhoneBook::factory()->create();

        $data = [
            'phone_book_id' => 'invalid',
            'birthday'      => '123',
            'email'         => 'invalid',
            'phone'         => '9999999999',
            'name'          => str_repeat('x', 256),
            'cpf'           => '12121212121212',
        ];

        $response = $this->post(route('api.contact.store', $phoneBook->id), $data);


        $response->assertStatus(422)
        ->assertJson([
            'success' => false,
            'message' => 'Erro de validação',
            'data'  => [
                'phone_book_id' => [
                    'O campo phone book id selecionado é inválido.',
                ],
                'birthday' => [
                    'O campo data de nascimento não é uma data válida.',
                ],
                'email' => [
                    'O campo e-mail deve ser um endereço de e-mail válido.',
                ],
                'phone' => [
                    'O campo telefone deve ter pelo menos 11 caracteres.',
                ],
                'name' => [
                    'O campo nome não pode ser superior a 255 caracteres.',
                ],
                'cpf' => [
                    'O campo CPF não pode ser superior a 11 caracteres.',
                ],
            ],
        ]);
    }
}
