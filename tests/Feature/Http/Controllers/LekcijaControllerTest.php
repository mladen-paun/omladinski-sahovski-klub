<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Lekcija;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;

/**
 * @see \App\Http\Controllers\LekcijaController
 */
final class LekcijaControllerTest extends TestCase
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
        Lekcija::factory()->create();
        $response = $this->actingAs($this->user)->get(route('lekcija.index'));
        $response->assertOk()->assertViewIs('lekcija.index')->assertViewHas('lekcijas');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->actingAs($this->user)->get(route('lekcija.create'));
        $response->assertOk()->assertViewIs('lekcija.create');
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
        $data = ['naziv' => 'Endgame', 'deo_partije' => 'Final position tactics'];
        $response = $this->actingAs($this->user)->post(route('lekcija.store'), $data);
        $this->assertDatabaseHas('lekcijas', ['naziv' => 'Endgame']);
        $response->assertRedirect(route('lekcija.index'));
    }


    #[Test]
    public function show_displays_view(): void
    {
        $lekcija = Lekcija::factory()->create();

        $response = $this->get(route('lekcija.show', $lekcija));

        $response->assertOk();
        $response->assertViewIs('lekcija.show');
        $response->assertViewHas('lekcija', $lekcija);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $l = Lekcija::factory()->create();
        $response = $this->actingAs($this->user)->get(route('lekcija.edit', $l));
        $response->assertOk()->assertViewIs('lekcija.edit')->assertViewHas('lekcija');
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
        $l = Lekcija::factory()->create();
        $data = ['naziv' => 'Opening', 'deo_partije' => 'First moves'];
        $response = $this->actingAs($this->user)->put(route('lekcija.update', $l), $data);
        $l->refresh();
        $this->assertEquals('Opening', $l->naziv);
        $response->assertRedirect(route('lekcija.index'));
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $l = Lekcija::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('lekcija.destroy', $l));
        $this->assertModelMissing($l);
        $response->assertRedirect(route('lekcija.index'));
    }
}
