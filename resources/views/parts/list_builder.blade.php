@foreach ($list as $item)

<tr>
@if ($errors->has('delete'))
    <span class="help-block">
        <strong>{{ $errors->first('category_id') }}</strong>
    </span>
@endif
</tr>
<tr>
    @foreach($fields as $col)
        <td>{{ $item->$col }}</td>
    @endforeach
    <td>
        <button type="button" img-id="{{ $item->id }}" onclick="window.location = '{{ action("$controller@view" , array('id' => $item->id)) }}'" class="btn">Show</button>
        <button type="button" img-id="{{ $item->id }}" onclick="window.location = '{{  action("$controller@edit" , array('id' => $item->id))  }}'" class="btn edit-item">Edit</button>
        <button type="button" img-id="{{ $item->id }}" onclick="if (confirm('Drop it ?')) { dropNode('{{$item->id}}'); } " class="btn btn-danger delete-item">Delete</button>

        <form action="{{action("$controller@delete" , array('id' => $item->id))}}" id='drop_{{ $item->id }}' >
            <input type="hidden" name="_method" value="DELETE">
        </form>
    </td>
</tr>
@endforeach