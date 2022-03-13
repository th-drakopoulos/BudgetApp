@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="card">
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
