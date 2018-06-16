<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $userMedicine->id !!}</p>
</div>

<!-- Qtt Field -->
<div class="form-group">
    {!! Form::label('qtt', 'Qtt:') !!}
    <p>{!! $userMedicine->qtt !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $userMedicine->user_id !!}</p>
</div>

<!-- Medicine Id Field -->
<div class="form-group">
    {!! Form::label('medicine_id', 'Medicine Id:') !!}
    <p>{!! $userMedicine->medicine_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $userMedicine->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $userMedicine->updated_at !!}</p>
</div>

