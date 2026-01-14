<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClanStoreRequest;
use App\Http\Requests\ClanUpdateRequest;
use App\Models\Clan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClanController extends Controller
{
    public function index(Request $request)
    {
        $clans = Clan::all();

        return view('clan.index', [
            'clans' => $clans,
        ]);
    }

    public function create(Request $request)
    {
        return view('clan.create');
    }

    public function store(ClanStoreRequest $request)
    {
        $clan = Clan::create($request->validated());

        $request->session()->flash('clan.id', $clan->id);

        return redirect()->route('clans.index');
    }

    public function show(Request $request, Clan $clan)
    {
        return view('clan.show', [
            'clan' => $clan,
        ]);
    }

    public function edit(Request $request, Clan $clan)
    {
        return view('clan.edit', [
            'clan' => $clan,
        ]);
    }

    public function update(ClanUpdateRequest $request, Clan $clan)
    {
        $clan->update($request->validated());

        $request->session()->flash('clan.id', $clan->id);

        return redirect()->route('clans.index');
    }

    public function destroy(Request $request, Clan $clan)
    {
        $clan->delete();

        return redirect()->route('clans.index');
    }
}
