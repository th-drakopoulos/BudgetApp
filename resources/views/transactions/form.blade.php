@csrf
<div class="form-group mb-3">
    <label for="description">Description</label>
    <input type="text" class="form-control  @error('description') is-invalid @enderror" name=" description"
        id="description" value="{{ old('description') ?: $transaction->description }}">
</div>
<div class="form-group mb-3">
    <label for="amount">Amount</label>
    <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount"
        value="{{ old('amount') ?: $transaction->amount }}">
</div>
<div class="form-group mb-3">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
        <option value=""></option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ $category->id == (old('category_id') ?: $transaction->category_id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
<button class="btn btn-success" type="submit">{{ isset($buttonText) ? $buttonText : 'Save' }}</button>
