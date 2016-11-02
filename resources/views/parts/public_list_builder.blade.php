@foreach($list as $item)
<tr>
    @foreach($fields as $col)
        <td source='{{action( 'PublicController@feedData' , array('id' => $item->id ) ) }}' title="{{ $item->$col }}" link="{{$item->link}}" data-toggle="modal" data-target="#feedModal">{{ $item->$col }}</td>
    @endforeach
    <td
    @if(trim($item->source->provider_url) != '')
        onclick="window.open('{{ trim($item->source->provider_url) }}','_blank');"
    @endif
    >{{ $item->source->title }}</td>
</tr>
@endforeach