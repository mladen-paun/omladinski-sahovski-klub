<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Kategorija;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;

/**
 * @see \App\Http\Controllers\KategorijaController
 */
final class KategorijaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    #[Test]
    public function index_displays_view(): void
    {
        Kategorija::factory()->create();
        $response = $this->actingAs($this->user)->get(route('kategorija.index'));
        $response->assertOk()->assertViewIs('kategorija.index')->assertViewHas('kategorijas');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->actingAs($this->user)->get(route('kategorija.create'));
        $response->assertOk()->assertViewIs('kategorija.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KategorijaController::class,
            'store',
            \App\Http\Requests\KategorijaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $data = ['naziv' => 'Junior'];
        $response = $this->actingAs($this->user)->post(route('kategorija.store'), $data);
        $this->assertDatabaseHas('kategorijas', ['naziv' => 'Junior']);
        $response->assertRedirect(route('kategorija.index'));
    }


    #[Test]
    public function show_displays_view(): void
    {
        $kategorija = Kategorija::factory()->create();

        $response = $this->actingAs($this->user)->get(route('kategorija.show', $kategorija));

        $response->assertOk();
        $response->assertViewIs('kategorija.show');
        $response->assertViewHas('kategorija', $kategorija);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $k = Kategorija::factory()->create();
        $response = $this->actingAs($this->user)->get(route('kategorija.edit', $k));
        $response->assertOk()->assertViewIs('kategorija.edit')->assertViewHas('kategorija');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KategorijaController::class,
            'update',
            \App\Http\Requests\KategorijaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $k = Kategorija::factory()->create();
        $data = ['naziv' => 'Senior'];
        $response = $this->actingAs($this->user)->put(route('kategorija.update', $k), $data);
        $k->refresh();
        $this->assertEquals('Senior', $k->naziv);
        $response->assertRedirect(route('kategorija.index'));
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $k = Kategorija::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('kategorija.destroy', $k));
        $this->assertModelMissing($k);
        $response->assertRedirect(route('kategorija.index'));
    }
}
