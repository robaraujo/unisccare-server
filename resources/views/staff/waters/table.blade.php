<table class="table" id="waters-table">
    <thead>
        <th>Qtt</th>
        <th>User Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($waters as $water)
        <tr>
            <td>{!! $water->qtt !!}</td>
            <td>{!! $water->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.waters.destroy', $water->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.waters.show', [$water->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('staff.waters.edit', [$water->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>