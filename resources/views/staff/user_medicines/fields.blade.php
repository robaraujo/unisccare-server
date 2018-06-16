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

<!-- Medicine Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medicine_id', 'Medicine Id:') !!}
    {!! Form::number('medicine_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('staff.userMedicines.index') !!}" class="btn btn-default">Cancel</a>
</div>
