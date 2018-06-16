<table class="table" id="weights-table">
    <thead>
        <th>User Id</th>
        <th>Weight</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($weights as $weight)
        <tr>
            <td>{!! $weight->user_id !!}</td>
            <td>{!! $weight->weight !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.weights.destroy', $weight->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.weights.show', [$weight->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('staff.weights.edit', [$weight->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>