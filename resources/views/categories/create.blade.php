@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Create Category</h4>
                        </div>
                        <div class="card-text">
                            <form action="/categories" method="POST">
                                @include('categories.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
