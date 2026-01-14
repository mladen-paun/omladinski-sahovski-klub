<div class="mb-3">
    <label for="ime" class="form-label">Ime</label>
    <input type="text" class="form-control" id="ime" name="ime" value="{{ old('ime', $trener->ime ?? '') }}">
</div>

<div class="mb-3">
    <label for="prezime" class="form-label">Prezime</label>
    <input type="text" class="form-control" id="prezime" name="prezime" value="{{ old('prezime', $trener->prezime ?? '') }}">
</div>

<div class="mb-3">
    <label for="broj_telefona" class="form-label">Broj telefona</label>
    <input type="text" class="form-control" id="broj_telefona" name="broj_telefona" value="{{ old('broj_telefona', $trener->broj_telefona ?? '') }}">
</div>

<div class="mb-3">
    <label for="jmbg" class="form-label">JMBG</label>
    <input type="text" class="form-control" id="jmbg" name="jmbg" value="{{ old('jmbg', $trener->jmbg ?? '') }}">
</div>