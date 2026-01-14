<!-- resources/views/clan/_form.blade.php -->
<div class="mb-3">
    <label for="ime" class="form-label">Ime</label>
    <input type="text" class="form-control" id="ime" name="ime" value="{{ old('ime', $clan->ime ?? '') }}">
</div>

<div class="mb-3">
    <label for="prezime" class="form-label">Prezime</label>
    <input type="text" class="form-control" id="prezime" name="prezime" value="{{ old('prezime', $clan->prezime ?? '') }}">
</div>

<div class="mb-3">
    <label for="godina_rodjenja" class="form-label">Godina rodjenja</label>
    <input type="date" class="form-control" id="godina_rodjenja" name="godina_rodjenja" value="{{ old('godina_rodjenja', $clan->godina_rodjenja ?? '') }}">
</div>

<div class="mb-3">
    <label for="fide_rejting" class="form-label">FIDE Rejting</label>
    <input type="number" step="0.01" class="form-control" id="fide_rejting" name="fide_rejting" value="{{ old('fide_rejting', $clan->fide_rejting ?? '') }}">
</div>

<div class="mb-3">
    <label for="kategorija_id" class="form-label">Kategorija</label>
    <select class="form-select" id="kategorija_id" name="kategorija_id">
        @foreach ($kategorijas as $kategorija)
            <option value="{{ $kategorija->id }}" 
                {{ old('kategorija_id', $clan->kategorija_id ?? '') == $kategorija->id ? 'selected' : '' }}>
                {{ $kategorija->naziv }}
            </option>
        @endforeach
    </select>
</div>