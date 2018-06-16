<table class="table" id="users-table">
    <thead>
        <th>Nome</th>
        <th>Primeiro Peso</th>
        <th>Último Peso</th>
        <th>Data Operação</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->first_name.' '.$user->last_name !!}</td>
            <td>{!! $user->first_weight !!}</td>
            <td>{!! $user->last_weight !!}</td>
            <td>{!! $user->dt_operation ? date('d/m/Y', strtotime($user->dt_operation)) : '' !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <!--<a href="{!! route('staff.users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>-->
                    <a href="{!! route('staff.users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>