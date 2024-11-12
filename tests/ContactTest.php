<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_displays_correctly()
    {
        $response = $this->actingAs(User::factory()->create())->get(route('contacts.create'));

        $response->assertStatus(200);
        $response->assertSeeText('Nome do Contato');
        $response->assertSeeText('E-mail do Contato');
    }

    public function test_contact_can_be_created()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('contacts.store'), [
            'name' => 'João da Silva',
            'email' => 'joao@example.com',
            'phone' => '123456789',
            'message' => 'Preciso de informações sobre os serviços.',
        ]);

        $response->assertRedirect(route('contacts.index'));
        $this->assertDatabaseHas('contacts', ['email' => 'joao@example.com']);
    }

    public function test_email_is_required_for_contact()
    {
        $response = $this->post(route('contacts.store'), [
            'name' => 'João da Silva',
            'phone' => '123456789',
            'message' => 'Preciso de informações sobre os serviços.',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
