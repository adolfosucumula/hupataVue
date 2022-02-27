
@extends("layouts.app")

@section("content")

<div class="container">
    <div class="col-md-12">
        <h2>Ups! 404 </h2>
        <h4>{{ $exception->getMessage() }}</h4>
    </div>
</div>

@endsection
