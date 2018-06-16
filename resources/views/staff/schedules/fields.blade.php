<div class="container">
  <div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'Usuário:') !!}
        {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'required'=> true]) !!}
    </div>

    <!-- Title Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('title', 'Título:') !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'required'=> true]) !!}
    </div>


    <!-- Date Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('date_date', 'Data:') !!}
        {!! 
            Form::text('date_date', isset($schedule) ? date('d/m/Y', strtotime($schedule->datehr)) : null, ['class' => 'form-control datepicker', 'required'=> true])
        !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('date_hour', 'Hora:') !!}
        {!!
            Form::text('date_time', isset($schedule) ? date('H:i a', strtotime($schedule->datehr)) : null, ['class' => 'form-control timepicker', 'required'=> true])
        !!}
    </div>
  </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('staff.schedules.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: "-1d"
    });
    $('.timepicker').timepicker();
</script>
@endsection