<div class="container">
  <div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('first_name', 'First Name:') !!}
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Last Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('last_name', 'Last Name:') !!}
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Password Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <!-- Age Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('age', 'Age:') !!}
        {!! Form::number('age', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Picture Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('picture', 'Picture:') !!}
        {!! Form::text('picture', null, ['class' => 'form-control']) !!}
    </div>

    <!-- State Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('state', 'State:') !!}
        {!! Form::text('state', null, ['class' => 'form-control']) !!}
    </div>

    <!-- City Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('city', 'City:') !!}
        {!! Form::text('city', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Gender Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('gender', 'Gender:') !!}
        {!! Form::text('gender', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Bio Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('bio', 'Bio:') !!}
        {!! Form::textarea('bio', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Staff Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('staff_id', 'Staff Id:') !!}
        {!! Form::number('staff_id', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Points Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('points', 'Points:') !!}
        {!! Form::number('points', null, ['class' => 'form-control']) !!}
    </div>

    <!-- First Weight Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('first_weight', 'First Weight:') !!}
        {!! Form::number('first_weight', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Last Weight Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('last_weight', 'Last Weight:') !!}
        {!! Form::number('last_weight', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('dt_operation', 'Data Operação:') !!}
        {!! 
            Form::text('dt_operation', isset($user) ? date('d/m/Y', strtotime($user->dt_operation)) : null, ['class' => 'form-control datepicker', 'required'=> true])
        !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('dt_end', 'Data Operação:') !!}
        {!! 
            Form::text('dt_end', isset($user) ? date('d/m/Y', strtotime($user->dt_end)) : null, ['class' => 'form-control datepicker', 'required'=> true])
        !!}
    </div>
  </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('staff.users.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
    });
    $('.timepicker').timepicker();
</script>
@endsection
