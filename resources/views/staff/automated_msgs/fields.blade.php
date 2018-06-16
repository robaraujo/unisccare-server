<!-- Portion Field -->
<div class="col-sm-6 col-w-addon">
  {{ Form::label('period_number', 'Período', ['class'=>'control-label', 'required'=> true]) }}
  <div class="form-group">
    <div class="input-group">
        {{ Form::number('period_number', null, ['class'=>'form-control percent', 'step' => 'any', 'required'=>true]) }}
        <span class="input-group-addon">
            {!! Form::select('period_type', [
              'day'=>'dias',
              'month'=>'meses',
              'year'=>'anos'
            ], null, ['class' => 'select-addon', 'required'=> true]) !!}
      </span>
    </div>
  </div>
</div>

<!-- Msg User Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('msg_user', 'Enviar para usuário:') !!}
    {!! Form::textarea('msg_user', null, ['class' => 'form-control']) !!}
</div>

<!-- Msg Staff Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('msg_staff', 'Para Você:') !!}
    {!! Form::textarea('msg_staff', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('staff.automatedMsgs.index') !!}" class="btn btn-default">Cancel</a>
</div>
