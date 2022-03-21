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
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->created_at->format('m/d/Y') }}</td>
                                        <td>
                                            <a href="/categories/{{ $category->slug }}">
                                                {{ $category->name }}
                                            </a>
                                        </td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <form action="/categories/{{ $category->slug }}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger btn-sm" type="submit">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
