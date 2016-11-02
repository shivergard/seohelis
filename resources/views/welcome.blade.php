@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">

                <span class='paginator'>
                {!!$feedItems->render()!!}
                </span>

                <div class="form-group">
                  <label class='control-label col-sm-2' for="sel1">Category:</label>
                  <select name='category_id' class="form-control" id="category" onchange="updateCategory(this);">
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

                <table class="table table-margin">
                    <thead>
                    @foreach($fields as $col)
                        <th>{{ trans('fields.'.$col) }}</th>
                    @endforeach
                    <th>{{ trans('fields.provider') }}</th>
                    </thead>
                    <tbody id="item-list">
                         @include('parts.public_list_builder' , array('list' => $feedItems , 'fields' => $fields))          
                    </tbody>
                  </table>

                <span class='paginator'>
                {!!$feedItems->render()!!}
                </span>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="feedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" id="modal_data">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="href_button" href="" onclick="window.open($(this).attr('href'),'_blank');" class="btn btn-primary">Open Feed Page</button>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
<script type="text/javascript">

    $('document').ready(
        function(){
            $.ajaxSetup({
               headers: { 'X-CSRF-Token' :  window.Laravel.csrfToken }
            });

            $("#feedModal").on("show.bs.modal", function(e) {
                var itemLink = $(e.relatedTarget);
                $(this).find("#myModalLabel").html(itemLink.attr("title"));
                $(this).find(".modal-body").load(itemLink.attr("source"));
                $(this).find("#href_button").attr("href" , itemLink.attr("link")); 
            });
        }
    );

    function deliver(data) {
        console.log('data delivered');
        if (data.status > 0){
            if (data.status == 1){
                $('.paginator').hide();
            }else{
                $('.paginator').show();
            }
            
            $('#item-list').html(data.html);
        }else{
            $('.paginator').show();
        }
        
    }


    function updateCategory(self) {

        var selectedCategory = $(self).val();

        var url = "{{ action('PublicController@filter') }}";

        var ajaxParams = {
          type: "POST",
          url: url,
          data: {
                    'category_id' : selectedCategory
                },
          success: deliver,
          dataType: 'json'
        };

        $.ajax(ajaxParams);
    }

</script>
@endsection