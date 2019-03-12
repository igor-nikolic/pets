@foreach($pets as $pet)
    <tr>
        <td><a href="{{ url('/') }}/pets/{{ $pet->pet_id }}" target="_blank">{{$pet->pet_name}}</a></td>
        <td>{{ ($pet->pet_gender == 'm') ? 'Male' : 'Female'}}</td>
        <td>{{ $pet->pet_birthday }}</td>
        <td><a href="{{ url('/') }}/pets/{{ $pet->pet_fatherID }}" target="_blank">{{ $pet->father_name }}</a></td>
        <td><a href="{{ url('/') }}/pets/{{ $pet->pet_motherID }}" target="_blank">{{ $pet->mother_name }}</a></td>
        <td><a href="mailto:{{ $pet->pet_owner_email }}?Subject=Mail%20for%20dog">{{ $pet->pet_owner_first_name }} {{$pet->pet_owner_last_name}}</a></td>
        <td>{{ $pet->pet_breed }}</td>
    </tr>
@endforeach
<tr>
    <td colspan="7" align="center">
        {!! $pets->links() !!}
    </td>
</tr>