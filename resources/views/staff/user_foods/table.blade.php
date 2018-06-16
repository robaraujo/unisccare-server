<table class="table" id="userFoods-table">
    <thead>
        <th>Qtt</th>
        <th>User Id</th>
        <th>Food Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($userFoods as $userFood)
        <tr>
            <td>{!! $userFood->qtt !!}</td>
            <td>{!! $userFood->user_id !!}</td>
            <td>{!! $userFood->food_id !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.userFoods.destroy', $userFood->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.userFoods.show', [$userFood->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('staff.userFoods.edit', [$userFood->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>