
<div class="container">
  <div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required'=>true]) !!}
    </div>

    <!-- Portion Field -->
    <div class="col-sm-6 col-w-addon">
      {{ Form::label('portion', 'Porção', ['class'=>'control-label']) }}
      <div class="form-group">
        <div class="input-group">
          {{ Form::number('portion', null, ['class'=>'form-control percent', 'step' => 'any', 'required'=>true]) }}
          <span class="input-group-append">
                {!! Form::select('unity', [
                  'mg'=>'mg',
                  'g'=>'g',
                  'kg'=>'kg',
                  'ml'=>'ml',
                  'litro'=>'litro',
                ], null, ['class' => 'select-addon']) !!}
          </span>
        </div>
      </div>
    </div>


    @foreach (['protein'=>'Proteínas', 'carb'=>'Carboidratos', 'satured_fat'=>'Gorduras Saturadas', 'trans_fat'=>'Gorduras Trans', 'total_fat'=>'Gorduras Totais', 'fiber'=>'Fibras Alimentares'] as $field=>$label)
    <div class="col-sm-4">
      {{ Form::label($field, $label, ['class'=>'control-label']) }}
      <div class="form-group">
        <div class="input-group">
          {{ Form::number($field, isset($food) ? null : 0, ['class'=>'form-control percent', 'step' => 'any']) }}
          <span class="input-group-append">
            <span class="input-group-text" id="basic-addon2">grama(s)</span>
          </span>
        </div>
      </div>
    </div>
    @endforeach
    @foreach (['sodium'=>'Sódio', 'iron'=>'Ferro', 'calcium'=>'Cálcio'] as $field=>$label)
    <div class="col-sm-4">
      {{ Form::label($field, $label, ['class'=>'control-label']) }}
      <div class="form-group">
        <div class="input-group">
          {{ Form::number($field, isset($food) ? null : 0, ['class'=>'form-control percent', 'step' => 'any']) }}
          <span class="input-group-append">
            <span class="input-group-text" id="basic-addon2">miligrama(s)</span>
          </span>
        </div>
      </div>
    </div>
    @endforeach

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('staff.foods.index') !!}" class="btn btn-default">Cancel</a>
    </div>
  </div>
</div>