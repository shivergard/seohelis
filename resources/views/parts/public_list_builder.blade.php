@foreach($list as $item)
<tr>
    @foreach($fields as $col)
        <td>{{ $item->$col }}</td>
    @endforeach
</tr>
@endforeach