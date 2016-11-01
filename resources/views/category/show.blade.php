@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">        
        <div class="col-md-12 col-md-offset-2">
            <button id="search_filter" type="button" onclick="window.location = '{{ action($controller."@list") }}'" class="btn btn-primary">Back</button>
            <button id="reset_filter" type="button" onclick="window.location = '{{ action($controller."@add") }}'" class="btn btn-primary">Create</button>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <h4>Showing {{ $category->name }}</h4>
            @foreach($fields as $col)
                <div class="form-group">
                    <div class="col-md-4"><strong>{{$col}}:</strong></div>
                    <div class="col-md-6">
                        {{ $category->$col }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
