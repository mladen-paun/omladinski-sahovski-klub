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
use App\Models\User;

/**
 * @see \App\Http\Controllers\ClanController
 */
final class ClanControllerTest extends TestCase
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
       Clan::factory()->create();
        $response = $this->actingAs($this->user)->get(route('clan.index'));
        $response->assertOk()->assertViewIs('clan.index')->assertViewHas('clans');
    }


    #[Test]
    public function create_displays_view(): void
    {  
        Kategorija::factory()->create();
        $response = $this->actingAs($this->user)->get(route('clan.create'));
        $response->assertOk()->assertViewIs('clan.create')->assertViewHas('kategorijas');
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
        $k = Kategorija::factory()->create();
        $data = [
            'ime' => 'Marko',
            'prezime' => 'Markovic',
            'godina_rodjenja' => '2005-05-05',
            'fide_rejting' => 1500,
            'kategorija_id' => $k->id,
        ];

        $response = $this->actingAs($this->user)->post(route('clan.store'), $data);
        $this->assertDatabaseHas('clans', ['ime' => 'Marko']); // ✅ will pass
        $response->assertRedirect(route('clan.index'));
    }


    #[Test]
    public function show_displays_view(): void
    {
        $clan = Clan::factory()->create();

        $response = $this->actingAs($this->user)->get(route('clan.show', $clan));

        $response->assertOk();
        $response->assertViewIs('clan.show');
        $response->assertViewHas('clan', $clan);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $clan = Clan::factory()->create();
        Kategorija::factory()->create();
        $response = $this->actingAs($this->user)->get(route('clan.edit', $clan));
        $response->assertOk()->assertViewIs('clan.edit')->assertViewHasAll(['clan', 'kategorijas']);
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
        $k = Kategorija::factory()->create();

        $data = [
            'ime' => 'Petar',
            'prezime' => 'Petrovic',
            'godina_rodjenja' => '2006-06-06',
            'fide_rejting' => 1600,
            'kategorija_id' => $k->id,
        ];
        print_r($data);

        $response = $this->actingAs($this->user)->put(route('clan.update', $clan), $data);

        $clan->refresh();
        $this->assertEquals('Petar', $clan->ime);
        $response->assertRedirect(route('clan.index'));
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $clan = Clan::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('clan.destroy', $clan));
        $this->assertModelMissing($clan);
        $response->assertRedirect(route('clan.index'));
    }
}
