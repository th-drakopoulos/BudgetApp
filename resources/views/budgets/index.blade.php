@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-title mt-2">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Monthly Budget</h4>
                    </div>
                    <div class="col-md-2 offset-md-6">
                        <form method="GET" id="months-form">
                            <select name="month" id="month" class="form-select"
                                onchange="document.getElementById('months-form').submit()">
                                <option value="Jan" {{ $currentMonth === 'Jan' ? 'selected' : '' }}>January</option>
                                <option value="Feb" {{ $currentMonth === 'Feb' ? 'selected' : '' }}>February</option>
                                <option value="Mar" {{ $currentMonth === 'Mar' ? 'selected' : '' }}>March</option>
                                <option value="Apr" {{ $currentMonth === 'Apr' ? 'selected' : '' }}>April</option>
                                <option value="May" {{ $currentMonth === 'May' ? 'selected' : '' }}>May</option>
                                <option value="Jun" {{ $currentMonth === 'Jun' ? 'selected' : '' }}>June</option>
                                <option value="Jul" {{ $currentMonth === 'Jul' ? 'selected' : '' }}>July</option>
                                <option value="Aug" {{ $currentMonth === 'Aug' ? 'selected' : '' }}>August</option>
                                <option value="Sep" {{ $currentMonth === 'Sep' ? 'selected' : '' }}>September</option>
                                <option value="Oct" {{ $currentMonth === 'Oct' ? 'selected' : '' }}>October</option>
                                <option value="Nov" {{ $currentMonth === 'Nov' ? 'selected' : '' }}>November</option>
                                <option value="Dec" {{ $currentMonth === 'Dec' ? 'selected' : '' }}>December</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($budgets as $budget)
                                    <tr>
                                        <td>
                                            <a href="/budgets/{{ $budget->id }}/edit">
                                                {{ $budget->category->name }}
                                            </a>
                                        </td>
                                        <td>{{ $budget->amount }}</td>
                                        <td>{{ $budget->balance() }}</td>
                                        <td>
                                            <form action="/budgets/{{ $budget->id }}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger btn-sm" type="submit">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
