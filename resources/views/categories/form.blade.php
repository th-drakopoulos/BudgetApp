@csrf
<div class="form-group mb-3">
    <label for="name">Name</label>
    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
        id="name" value="{{ old('name') ?: $category->name }}">
</div>
<button class="btn btn-success" type="submit">{{ isset($buttonText) ? $buttonText : 'Save' }}</button>
