<!-- Qtt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qtt', 'Qtt:') !!}
    {!! Form::number('qtt', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Food Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('food_id', 'Food Id:') !!}
    {!! Form::number('food_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('staff.userFoods.index') !!}" class="btn btn-default">Cancel</a>
</div>
