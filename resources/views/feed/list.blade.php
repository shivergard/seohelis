@extends('layouts.app')

@section('content')
     
<div class="main-list-right">
    <div class="container clearfix">
    <h4>Feed List</h4>
    <button type="button" onclick="window.location = '{{ action("FeedSourcesController@add") }}'"  class="btn btn-primary headder-button">+ new</button>
    <hr>
    <div class="relative-list clearfix">

    {!!$list->render()!!}
    <table class="table table-margin">
        <thead>
        <th>Category</th>
        @foreach($fields as $col)
            <th>{{ trans('fields.'.$col) }}</th>
        @endforeach
        <th>Actions</th>
        </thead>
        <tbody id="item-list">
             @include('feed.list_builder' , array('list' => $list , 'controller' => 'FeedSourcesController'))          
        </tbody>
      </table>
      {!!$list->render()!!}
    </div>
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
    function dropNode(data){
        $('#drop_'+ data).submit();
    }
</script>
@endsection
