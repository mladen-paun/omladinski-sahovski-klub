<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Lekcija;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LekcijaController
 */
final class LekcijaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $lekcijas = Lekcija::factory()->count(3)->create();

        $response = $this->get(route('lekcijas.index'));

        $response->assertOk();
        $response->assertViewIs('lekcija.index');
        $response->assertViewHas('lekcijas', $lekcijas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('lekcijas.create'));

        $response->assertOk();
        $response->assertViewIs('lekcija.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LekcijaController::class,
            'store',
            \App\Http\Requests\LekcijaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv = fake()->word();
        $deo_partije = fake()->text();

        $response = $this->post(route('lekcijas.store'), [
            'naziv' => $naziv,
            'deo_partije' => $deo_partije,
        ]);

        $lekcijas = Lekcija::query()
            ->where('naziv', $naziv)
            ->where('deo_partije', $deo_partije)
            ->get();
        $this->assertCount(1, $lekcijas);
        $lekcija = $lekcijas->first();

        $response->assertRedirect(route('lekcijas.index'));
        $response->assertSessionHas('lekcija.id', $lekcija->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $lekcija = Lekcija::factory()->create();

        $response = $this->get(route('lekcijas.show', $lekcija));

        $response->assertOk();
        $response->assertViewIs('lekcija.show');
        $response->assertViewHas('lekcija', $lekcija);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $lekcija = Lekcija::factory()->create();

        $response = $this->get(route('lekcijas.edit', $lekcija));

        $response->assertOk();
        $response->assertViewIs('lekcija.edit');
        $response->assertViewHas('lekcija', $lekcija);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LekcijaController::class,
            'update',
            \App\Http\Requests\LekcijaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $lekcija = Lekcija::factory()->create();
        $naziv = fake()->word();
        $deo_partije = fake()->text();

        $response = $this->put(route('lekcijas.update', $lekcija), [
            'naziv' => $naziv,
            'deo_partije' => $deo_partije,
        ]);

        $lekcija->refresh();

        $response->assertRedirect(route('lekcijas.index'));
        $response->assertSessionHas('lekcija.id', $lekcija->id);

        $this->assertEquals($naziv, $lekcija->naziv);
        $this->assertEquals($deo_partije, $lekcija->deo_partije);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $lekcija = Lekcija::factory()->create();

        $response = $this->delete(route('lekcijas.destroy', $lekcija));

        $response->assertRedirect(route('lekcijas.index'));

        $this->assertModelMissing($lekcija);
    }
}
