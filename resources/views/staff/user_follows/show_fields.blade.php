<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $userFollow->user_id !!}</p>
</div>

<!-- Following Id Field -->
<div class="form-group">
    {!! Form::label('following_id', 'Following Id:') !!}
    <p>{!! $userFollow->following_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $userFollow->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $userFollow->updated_at !!}</p>
</div>

