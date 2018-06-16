<table class="table" id="forums-table">
    <thead>
        <th>Name</th>
        <th>Admin Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($forums as $forum)
        <tr>
            <td>{!! $forum->name !!}</td>
            <td>{!! $forum->admin_id !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.forums.destroy', $forum->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.forums.show', [$forum->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('staff.forums.edit', [$forum->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>