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

        <div class="form-group">
          <label class='control-label col-sm-2' for="sel1">Category:</label>
          <select name='category_id' class="form-control" id="category">
                <option>None</option>
                @foreach ($categories as $category)
                    <option value='{{ $category->id }}'>{{ $category->name }}</option>
                @endforeach
          </select>

            @if ($errors->has('category_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_id') }}</strong>
                </span>
            @endif
        </div>

        @foreach($fields as $col)
            <div class="form-group">

                <label class="control-label col-sm-2" for="{{$col}}">{{ trans('fields.'.$col) }}:</label>
                <div class="col-sm-10">
                  <input class="form-control" name="{{$col}}" id="{{$col}}" placeholder="Enter {{ trans('fields.'.$col) }}" value="{{Input::old($col)}}">
                </div>

                @if ($errors->has($col))
                    <span class="help-block">
                        <strong>{{ $errors->first($col) }}</strong>
                    </span>
                @endif

            </div>
        @endforeach

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Create</button>
        </div>
      </div>

    </form>
</div>
@endsection
