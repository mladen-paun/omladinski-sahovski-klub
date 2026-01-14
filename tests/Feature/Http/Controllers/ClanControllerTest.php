<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Clan;
use App\Models\Kategorija;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ClanController
 */
final class ClanControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $clans = Clan::factory()->count(3)->create();

        $response = $this->get(route('clans.index'));

        $response->assertOk();
        $response->assertViewIs('clan.index');
        $response->assertViewHas('clans', $clans);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('clans.create'));

        $response->assertOk();
        $response->assertViewIs('clan.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClanController::class,
            'store',
            \App\Http\Requests\ClanStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $ime = fake()->word();
        $prezime = fake()->word();
        $godina_rodjenja = Carbon::parse(fake()->date());
        $fide_rejting = fake()->randomFloat(/** float_attributes **/);
        $kategorija = Kategorija::factory()->create();

        $response = $this->post(route('clans.store'), [
            'ime' => $ime,
            'prezime' => $prezime,
            'godina_rodjenja' => $godina_rodjenja->toDateString(),
            'fide_rejting' => $fide_rejting,
            'kategorija_id' => $kategorija->id,
        ]);

        $clans = Clan::query()
            ->where('ime', $ime)
            ->where('prezime', $prezime)
            ->where('godina_rodjenja', $godina_rodjenja)
            ->where('fide_rejting', $fide_rejting)
            ->where('kategorija_id', $kategorija->id)
            ->get();
        $this->assertCount(1, $clans);
        $clan = $clans->first();

        $response->assertRedirect(route('clans.index'));
        $response->assertSessionHas('clan.id', $clan->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $clan = Clan::factory()->create();

        $response = $this->get(route('clans.show', $clan));

        $response->assertOk();
        $response->assertViewIs('clan.show');
        $response->assertViewHas('clan', $clan);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $clan = Clan::factory()->create();

        $response = $this->get(route('clans.edit', $clan));

        $response->assertOk();
        $response->assertViewIs('clan.edit');
        $response->assertViewHas('clan', $clan);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClanController::class,
            'update',
            \App\Http\Requests\ClanUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $clan = Clan::factory()->create();
        $ime = fake()->word();
        $prezime = fake()->word();
        $godina_rodjenja = Carbon::parse(fake()->date());
        $fide_rejting = fake()->randomFloat(/** float_attributes **/);
        $kategorija = Kategorija::factory()->create();

        $response = $this->put(route('clans.update', $clan), [
            'ime' => $ime,
            'prezime' => $prezime,
            'godina_rodjenja' => $godina_rodjenja->toDateString(),
            'fide_rejting' => $fide_rejting,
            'kategorija_id' => $kategorija->id,
        ]);

        $clan->refresh();

        $response->assertRedirect(route('clans.index'));
        $response->assertSessionHas('clan.id', $clan->id);

        $this->assertEquals($ime, $clan->ime);
        $this->assertEquals($prezime, $clan->prezime);
        $this->assertEquals($godina_rodjenja, $clan->godina_rodjenja);
        $this->assertEquals($fide_rejting, $clan->fide_rejting);
        $this->assertEquals($kategorija->id, $clan->kategorija_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $clan = Clan::factory()->create();

        $response = $this->delete(route('clans.destroy', $clan));

        $response->assertRedirect(route('clans.index'));

        $this->assertModelMissing($clan);
    }
}
