@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Create Transaction</h4>
                        </div>
                        <div class="card-text">
                            <form action="/transactions" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control  @error('description') is-invalid @enderror"
                                        name=" description" id="description" value="{{ old('description') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                        name="amount" id="amount" value="{{ old('amount') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == old('category_id') ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-success" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
