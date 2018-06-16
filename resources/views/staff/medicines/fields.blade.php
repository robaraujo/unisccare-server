<div class="container">
  <div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Nome:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Active Compound Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('active_compound', 'Princípio Ativo:') !!}
        {!! Form::text('active_compound', null, ['class' => 'form-control']) !!}
    </div>
  </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('staff.medicines.index') !!}" class="btn btn-default">Cancel</a>
</div>
