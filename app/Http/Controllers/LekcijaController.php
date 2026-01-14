<?php

namespace App\Http\Controllers;

use App\Http\Requests\LekcijaStoreRequest;
use App\Http\Requests\LekcijaUpdateRequest;
use App\Models\Lekcija;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LekcijaController extends Controller
{
    public function index(Request $request)
    {
        $lekcijas = Lekcija::all();

        return view('lekcija.index', [
            'lekcijas' => $lekcijas,
        ]);
    }

    public function create(Request $request)
    {
        return view('lekcija.create');
    }

    public function store(LekcijaStoreRequest $request)
    {
        $lekcija = Lekcija::create($request->validated());

        $request->session()->flash('lekcija.id', $lekcija->id);

        return redirect()->route('lekcija.index');
    }

    public function show(Request $request, Lekcija $lekcija)
    {
        return view('lekcija.show', [
            'lekcija' => $lekcija,
        ]);
    }

    public function edit(Request $request, Lekcija $lekcija)
    {
        return view('lekcija.edit', [
            'lekcija' => $lekcija,
        ]);
    }

    public function update(LekcijaUpdateRequest $request, Lekcija $lekcija)
    {
        $lekcija->update($request->validated());

        $request->session()->flash('lekcija.id', $lekcija->id);

        return redirect()->route('lekcija.index');
    }

    public function destroy(Request $request, Lekcija $lekcija)
    {
        $lekcija->delete();

        return redirect()->route('lekcija.index');
    }
}
