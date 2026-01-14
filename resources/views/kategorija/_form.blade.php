<!-- resources/views/kategorija/_form.blade.php -->
<div class="mb-3">
    <label for="naziv" class="form-label">Naziv</label>
    <input type="text" class="form-control" id="naziv" name="naziv" value="{{ old('naziv', $kategorija->naziv ?? '') }}">
</div>