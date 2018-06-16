<table class="table" id="staff-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Bio</th>
        <th>Clinic</th>
        <th>Degree</th>
        <th>Remember Token</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($staff as $staff)
        <tr>
            <td>{!! $staff->name !!}</td>
            <td>{!! $staff->email !!}</td>
            <td>{!! $staff->password !!}</td>
            <td>{!! $staff->age !!}</td>
            <td>{!! $staff->gender !!}</td>
            <td>{!! $staff->bio !!}</td>
            <td>{!! $staff->clinic !!}</td>
            <td>{!! $staff->degree !!}</td>
            <td>{!! $staff->remember_token !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.staff.destroy', $staff->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.staff.show', [$staff->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('staff.staff.edit', [$staff->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>