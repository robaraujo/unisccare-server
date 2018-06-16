<table class="table" id="photos-table">
    <thead>
        <th>User Id</th>
        <th>Base64</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($photos as $photo)
        <tr>
            <td>{!! $photo->user_id !!}</td>
            <td>{!! $photo->base64 !!}</td>
            <td>
                {!! Form::open(['route' => ['staff.photos.destroy', $photo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staff.photos.show', [$photo->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('staff.photos.edit', [$photo->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>