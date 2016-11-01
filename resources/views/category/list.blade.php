@extends('layouts.app')

@section('content')
     
<div class="main-list-right">
    <div class="container clearfix">
    <h4>Category List</h4>
    <button type="button" onclick="window.location = '{{ action("FeedCategoryController@add") }}'"  class="btn btn-primary headder-button">+ new</button>
    <hr>
    <div class="relative-list clearfix">

    {!!$list->render()!!}
    <table class="table table-margin">
        <thead>
        @foreach($fields as $col)
            <th>{{ trans('fields.'.$col) }}</th>
        @endforeach
        <th>Actions</th>
        </thead>
        <tbody id="item-list">
             @include('parts.list_builder' , array('list' => $list , 'controller' => 'FeedCategoryController'))          
        </tbody>
      </table>
      {!!$list->render()!!}
    </div>
    </div>
</div>


@endsection

