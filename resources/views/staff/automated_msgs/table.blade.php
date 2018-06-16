<table class="table" id="automatedMsgs-table">
    <thead>
        <tr>
            <th>Data</th>
            <th colspan="3">Ação</th>
        </tr>
    </thead>
    <tbody>
    @foreach($automatedMsgs as $automatedMsg)
        <tr>
            <td>{!! $automatedMsg->period_number !!} {!! $automatedMsg->period_type !!}(s)</td>
            <td>
                {!! Form::open(['route' => ['staff.automatedMsgs.destroy', $automatedMsg->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.automatedMsgs.edit', [$automatedMsg->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>