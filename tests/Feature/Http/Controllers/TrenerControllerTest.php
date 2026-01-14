<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Trener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TrenerController
 */
final class TrenerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $treners = Trener::factory()->count(3)->create();

        $response = $this->get(route('treners.index'));

        $response->assertOk();
        $response->assertViewIs('trener.index');
        $response->assertViewHas('treners', $treners);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('treners.create'));

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
        $ime = fake()->word();
        $prezime = fake()->word();
        $broj_telefona = fake()->word();
        $jmbg = fake()->word();

        $response = $this->post(route('treners.store'), [
            'ime' => $ime,
            'prezime' => $prezime,
            'broj_telefona' => $broj_telefona,
            'jmbg' => $jmbg,
        ]);

        $treners = Trener::query()
            ->where('ime', $ime)
            ->where('prezime', $prezime)
            ->where('broj_telefona', $broj_telefona)
            ->where('jmbg', $jmbg)
            ->get();
        $this->assertCount(1, $treners);
        $trener = $treners->first();

        $response->assertRedirect(route('treners.index'));
        $response->assertSessionHas('trener.id', $trener->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $trener = Trener::factory()->create();

        $response = $this->get(route('treners.show', $trener));

        $response->assertOk();
        $response->assertViewIs('trener.show');
        $response->assertViewHas('trener', $trener);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $trener = Trener::factory()->create();

        $response = $this->get(route('treners.edit', $trener));

        $response->assertOk();
        $response->assertViewIs('trener.edit');
        $response->assertViewHas('trener', $trener);
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
        $ime = fake()->word();
        $prezime = fake()->word();
        $broj_telefona = fake()->word();
        $jmbg = fake()->word();

        $response = $this->put(route('treners.update', $trener), [
            'ime' => $ime,
            'prezime' => $prezime,
            'broj_telefona' => $broj_telefona,
            'jmbg' => $jmbg,
        ]);

        $trener->refresh();

        $response->assertRedirect(route('treners.index'));
        $response->assertSessionHas('trener.id', $trener->id);

        $this->assertEquals($ime, $trener->ime);
        $this->assertEquals($prezime, $trener->prezime);
        $this->assertEquals($broj_telefona, $trener->broj_telefona);
        $this->assertEquals($jmbg, $trener->jmbg);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $trener = Trener::factory()->create();

        $response = $this->delete(route('treners.destroy', $trener));

        $response->assertRedirect(route('treners.index'));

        $this->assertModelMissing($trener);
    }
}
