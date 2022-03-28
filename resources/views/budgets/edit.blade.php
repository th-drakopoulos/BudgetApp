@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Update Budget</h4>
                        </div>
                        <div class="card-text">
                            <form action="/budgets/{{ $budget->id }}" method="POST">
                                {{ method_field('PUT') }}
                                @include('budgets.form', ['buttonText' => 'Update'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
