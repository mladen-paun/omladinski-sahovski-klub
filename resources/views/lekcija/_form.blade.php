<!-- resources/views/lekcija/_form.blade.php -->
<div class="mb-3">
    <label for="naziv" class="form-label">Naziv</label>
    <input type="text" class="form-control" id="naziv" name="naziv" value="{{ old('naziv', $lekcija->naziv ?? '') }}">
</div>

<div class="mb-3">
    <label for="deo_partije" class="form-label">Deo Partije</label>
    <textarea class="form-control" id="deo_partije" name="deo_partije" rows="5">{{ old('deo_partije', $lekcija->deo_partije ?? '') }}</textarea>
</div>