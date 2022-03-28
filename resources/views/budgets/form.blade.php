@csrf
<div class="form-group mb-3">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
        <option value=""></option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ $category->id == (old('category_id') ?: $budget->category_id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group mb-3">
    <label for="amount">Amount</label>
    <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount"
        value="{{ old('amount') ?: $budget->amount }}">
</div>
<div class="form-group mb-3">
    <label for="budget_date">Budget Date</label>
    <select name="budget_date" id="budget_date" class="form-control @error('budget_date') is-invalid @enderror">
        <option value=""></option>
        @foreach ($months as $month)
            <option value="{{ $month }}" {{ $month == $budget->getMonth() ? 'selected' : '' }}>
                {{ $month }}
            </option>
        @endforeach
    </select>
</div>
<button class="btn btn-success" type="submit">{{ isset($buttonText) ? $buttonText : 'Save' }}</button>
