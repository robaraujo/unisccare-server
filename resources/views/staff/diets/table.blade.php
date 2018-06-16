<table class="table" id="diets-table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Ativo</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
    @foreach($diets as $diet)
        <tr>
            <td>{!! $diet->title !!}</td>
            <td>{!! $diet->active !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.diets.destroy', $diet->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.diets.edit', [$diet->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>