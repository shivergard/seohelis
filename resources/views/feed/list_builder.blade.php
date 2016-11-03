@foreach ($list as $item)
<tr>
    <td>{{ $item->category->name }}</td>
    @foreach($fields as $col)
        <td>{{ $item->$col }}</td>
    @endforeach
    <td>
        <button type="button" img-id="{{ $item->id }}" onclick="window.location = '{{ action("$controller@view" , array('id' => $item->id)) }}'" class="btn">Show</button>
        <button type="button" img-id="{{ $item->id }}" onclick="window.location = '{{  action("$controller@edit" , array('id' => $item->id))  }}'" class="btn edit-item">Edit</button>
        <button type="button" img-id="{{ $item->id }}" onclick="if (confirm('Drop it ?')) { dropNode('{{$item->id}}'); } " class="btn btn-danger delete-item">Delete</button>

        <form method="post" action="{{action("$controller@delete")}}" id='drop_{{ $item->id }}'  >
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $item->id }}">
        </form>
    </td>
</tr>
@endforeach