<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $userFood->id !!}</p>
</div>

<!-- Qtt Field -->
<div class="form-group">
    {!! Form::label('qtt', 'Qtt:') !!}
    <p>{!! $userFood->qtt !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $userFood->user_id !!}</p>
</div>

<!-- Food Id Field -->
<div class="form-group">
    {!! Form::label('food_id', 'Food Id:') !!}
    <p>{!! $userFood->food_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $userFood->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $userFood->updated_at !!}</p>
</div>

