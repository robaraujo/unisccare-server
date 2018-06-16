<table class="table" id="userFollows-table">
    <thead>
        <th>User Id</th>
        <th>Following Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($userFollows as $userFollow)
        <tr>
            <td>{!! $userFollow->user_id !!}</td>
            <td>{!! $userFollow->following_id !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.userFollows.destroy', $userFollow->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.userFollows.show', [$userFollow->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('staff.userFollows.edit', [$userFollow->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>