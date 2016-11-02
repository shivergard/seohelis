@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">

                {!!$feedItems->render()!!}

                <table class="table table-margin">
                    <thead>
                    @foreach($fields as $col)
                        <th>{{ trans('fields.'.$col) }}</th>
                    @endforeach
                    </thead>
                    <tbody id="item-list">
                         @include('parts.public_list_builder' , array('list' => $feedItems , 'fields' => $fields))          
                    </tbody>
                  </table>

                  {!!$feedItems->render()!!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
