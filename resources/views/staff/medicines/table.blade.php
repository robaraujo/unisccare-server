<table class="table" id="medicines-table">
    <thead>
        <th>Nome</th>
        <th>Princípio Ativo</th>
        <th colspan="3">Ação</th>
    </thead>
    <tbody>
    @foreach($medicines as $medicine)
        <tr>
            <td>{!! $medicine->name !!}</td>
            <td>{!! $medicine->active_compound !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.medicines.destroy', $medicine->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.medicines.edit', [$medicine->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
