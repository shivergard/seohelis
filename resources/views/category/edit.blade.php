@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <button id="search_filter" type="button" onclick="window.location = '{{ action($controller."@list") }}'" class="btn btn-primary">Back</button>
        </div>
        <div class="col-md-8 col-md-offset-2">
    <!-- if there are creation errors, they will show here -->
    <form method="POST" class="form-horizontal" action="{{ action($controller."@store") }}">
        {{ csrf_field() }}
        
        @foreach($fields as $col)
            <div class="form-group">

                <label class="control-label col-sm-2" for="{{$col}}">{{ trans('fields.'.$col) }}:</label>
                <div class="col-sm-10">
                  <input class="form-control" name="{{$col}}" id="{{$col}}" placeholder="Enter {{ trans('fields.'.$col) }}" value="{{ $category->$col }}">
                </div>

                @if ($errors->has($col))
                    <span class="help-block">
                        <strong>{{ $errors->first($col) }}</strong>
                    </span>
                @endif

            </div>
        @endforeach

        <input type="hidden" name="id" value="{{ $category->id }}">

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Edit</button>
        </div>
      </div>

    </form>
</div>
@endsection
