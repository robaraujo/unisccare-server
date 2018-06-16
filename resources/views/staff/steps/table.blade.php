<table class="table" id="steps-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>Steps</th>
        <th>Start Date</th>
        <th>End Date</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($steps as $step)
        <tr>
            <td>{!! $step->user_id !!}</td>
            <td>{!! $step->steps !!}</td>
            <td>{!! $step->start_date !!}</td>
            <td>{!! $step->end_date !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.steps.destroy', $step->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.steps.show', [$step->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('staff.steps.edit', [$step->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>