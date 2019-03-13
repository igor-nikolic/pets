@foreach($breeds as $breed)
    <tr>
        <td>{{ $breed->id }}</td>
        <td>{{ $breed->name }}</td>
        <td><a href="{{ url('/') }}/admin/breeds/{{ $breed->id }}/edit" target="_blank">Edit</a></td></td>
    </tr>
@endforeach
<tr>
    <td colspan="7" align="center">
        {!! $breeds->links() !!}
    </td>
</tr>