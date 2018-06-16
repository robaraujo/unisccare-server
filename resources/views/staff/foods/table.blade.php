<table class="table" id="foods-table">
    <thead>
        <th>Nome</th>
        <th>Porção</th>
        <th>Proteína</th>
        <th>Carboidrato</th>
        <th>Gordura Saturada</th>
        <th>Gordura Trans</th>
        <th>Gordura Total</th>
        <th colspan="3">Ação</th>
    </thead>
    <tbody>
    @foreach($foods as $food)
        <tr>
            <td>{!! $food->name !!}</td>
            <td>{!! $food->portion.$food->unity !!}</td>
            <td>{!! $food->protein !!}g</td>
            <td>{!! $food->carb !!}g</td>
            <td>{!! $food->satured_fat !!}g</td>
            <td>{!! $food->trans_fat !!}g</td>
            <td>{!! $food->total_fat !!}g</td>
            <td>
                {!! Form::open(['route' => ['staff.foods.destroy', $food->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.foods.edit', [$food->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
