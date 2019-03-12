@foreach($users as $user)
    <tr>
        <td>{{ $user->user_id }}</td>
        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ ($user->user_roleId == 1) ? 'admin' : 'user' }}</td>
        <td>{{ $user->created_at }}</td>
        <td>{{ $user->deleted_at }}</td>
        <td>{{ $user->activated_at }}</td>
        <td>{{ $user->updated_at }}</td>
        <td><a href="{{ url('/') }}/admin/users/{{ $user->user_id }}/edit" target="_blank">Edit</a></td></td>
        {{--<td><a href="{{ url('/') }}/pets/{{ $pet->pet_id }}" target="_blank">{{$pet->pet_name}}</a></td>--}}
        {{--<td>{{ ($pet->pet_gender == 'm') ? 'Male' : 'Female'}}</td>--}}
        {{--<td>{{ $pet->pet_birthday }}</td>--}}
        {{--<td><a href="{{ url('/') }}/pets/{{ $pet->pet_fatherID }}" target="_blank">{{ $pet->father_name }}</a></td>--}}
        {{--<td><a href="{{ url('/') }}/pets/{{ $pet->pet_motherID }}" target="_blank">{{ $pet->mother_name }}</a></td>--}}
        {{--<td><a href="mailto:{{ $pet->pet_owner_email }}?Subject=Mail%20for%20dog">{{ $pet->pet_owner_first_name }} {{$pet->pet_owner_last_name}}</a></td>--}}
        {{--<td>{{ $pet->pet_breed }}</td>--}}
    </tr>
@endforeach
<tr>
    <td colspan="7" align="center">
        {!! $users->links() !!}
    </td>
</tr>