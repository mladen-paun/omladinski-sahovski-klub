<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Kategorija;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\KategorijaController
 */
final class KategorijaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $kategorijas = Kategorija::factory()->count(3)->create();

        $response = $this->get(route('kategorijas.index'));

        $response->assertOk();
        $response->assertViewIs('kategorija.index');
        $response->assertViewHas('kategorijas', $kategorijas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('kategorijas.create'));

        $response->assertOk();
        $response->assertViewIs('kategorija.create');
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
        $naziv = fake()->word();

        $response = $this->post(route('kategorijas.store'), [
            'naziv' => $naziv,
        ]);

        $kategorijas = Kategorija::query()
            ->where('naziv', $naziv)
            ->get();
        $this->assertCount(1, $kategorijas);
        $kategorija = $kategorijas->first();

        $response->assertRedirect(route('kategorijas.index'));
        $response->assertSessionHas('kategorija.id', $kategorija->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $kategorija = Kategorija::factory()->create();

        $response = $this->get(route('kategorijas.show', $kategorija));

        $response->assertOk();
        $response->assertViewIs('kategorija.show');
        $response->assertViewHas('kategorija', $kategorija);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $kategorija = Kategorija::factory()->create();

        $response = $this->get(route('kategorijas.edit', $kategorija));

        $response->assertOk();
        $response->assertViewIs('kategorija.edit');
        $response->assertViewHas('kategorija', $kategorija);
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
        $kategorija = Kategorija::factory()->create();
        $naziv = fake()->word();

        $response = $this->put(route('kategorijas.update', $kategorija), [
            'naziv' => $naziv,
        ]);

        $kategorija->refresh();

        $response->assertRedirect(route('kategorijas.index'));
        $response->assertSessionHas('kategorija.id', $kategorija->id);

        $this->assertEquals($naziv, $kategorija->naziv);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $kategorija = Kategorija::factory()->create();

        $response = $this->delete(route('kategorijas.destroy', $kategorija));

        $response->assertRedirect(route('kategorijas.index'));

        $this->assertModelMissing($kategorija);
    }
}
