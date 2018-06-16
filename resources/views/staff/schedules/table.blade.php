<table class="table" id="schedules-table">
    <thead>
        <th>Usuário</th>
        <th>Title</th>
        <th>Date</th>
        <th>Status</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($schedules as $schedule)
        <tr class="schedule-{!! $schedule->suggestion_accepted == 1 ? 'accepted' : 'wainting'!!}">
            <td>{!! $schedule->user->first_name.' '.$schedule->user->last_name !!}</td>
            <td>{!! $schedule->title !!}</td>
            <td>
                {!! date('d/m/Y', strtotime($schedule->datehr)) !!}
                {!! date('H:i', strtotime($schedule->datehr)) !!}
            </td>
            <td>{!! $schedule->suggestion_accepted == 1 ? 'Aceito' : 'Pendente' !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.schedules.destroy', $schedule->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.schedules.edit', [$schedule->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>

                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>