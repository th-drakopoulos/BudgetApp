@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-title mt-2">
                <div class="row">
                    <div class="col-md-2 offset-md-10">
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
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
                                        <td>
                                            <a href="/transactions/{{ $transaction->id }}">
                                                {{ $transaction->description }}
                                            </a>
                                        </td>
                                        <td>{{ $transaction->category->name }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>
                                            <form action="/transactions/{{ $transaction->id }}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger btn-sm" type="submit">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
