<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Trener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;

/**
 * @see \App\Http\Controllers\TrenerController
 */
final class TrenerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for authentication
        $this->user = User::factory()->create();
    }

    #[Test]
    public function index_displays_view(): void
    {

        $response = $this->actingAs($this->user)->get(route('trener.index'));

        $response->assertOk();
        $response->assertViewIs('trener.index');
        $response->assertViewHas('treners');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->actingAs($this->user)->get(route('trener.create'));

        $response->assertOk();
        $response->assertViewIs('trener.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TrenerController::class,
            'store',
            \App\Http\Requests\TrenerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $data = [
            'ime' => 'Marko',
            'prezime' => 'Markovic',
            'broj_telefona' => '0651234567',
            'jmbg' => '0101001234567',
        ];

        $response = $this->actingAs($this->user)->post(route('trener.store'), $data);

        $trener = Trener::where('ime', 'Marko')->first();
        $this->assertNotNull($trener);
        $response->assertRedirect(route('trener.index'));
    }


    #[Test]
    public function show_displays_view(): void
    {
        $trener = Trener::factory()->create();

        $response = $this->actingAs($this->user)->get(route('trener.show', $trener));

        $response->assertOk();
        $response->assertViewIs('trener.show');
        $response->assertViewHas('trener');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $trener = Trener::factory()->create();

        $response = $this->actingAs($this->user)->get(route('trener.edit', $trener));

        $response->assertOk();
        $response->assertViewIs('trener.edit');
        $response->assertViewHas('trener');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TrenerController::class,
            'update',
            \App\Http\Requests\TrenerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $trener = Trener::factory()->create();

        $data = [
            'ime' => 'Petar',
            'prezime' => 'Petrovic',
            'broj_telefona' => '0659876543',
            'jmbg' => '0101007654321',
        ];

        $response = $this->actingAs($this->user)->put(route('trener.update', $trener), $data);

        $trener->refresh();
        $this->assertEquals('Petar', $trener->ime);
        $response->assertRedirect(route('trener.index'));
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $trener = Trener::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('trener.destroy', $trener));

        $this->assertModelMissing($trener);
        $response->assertRedirect(route('trener.index'));
    }
}
