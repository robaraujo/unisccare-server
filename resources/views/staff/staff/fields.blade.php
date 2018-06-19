<div class="container">
    <div class="row">
        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Email Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('role', 'Cargo:') !!}
            {!! Form::text('role', null, ['class' => 'form-control']) !!}
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

        <!-- Email Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('access', 'Acessos:') !!}
            {!! Form::select('unity', [
                  'users'=>'Usuários',
                  'reports'=>'Relatórios',
                  'chat'=>'Chat',
                  'automated_msgs'=>'Mensagens Automatizadas',
                  'diets'=>'Dietas',
                  'foods'=>'Alimentos',
                  'medicines'=>'Medicamentos',
                  'schedules'=>'Compromissos',
                  'rates'=>'Avaliações',
                ], null, ['class' => 'form-control', 'multiple'=>true]) !!}
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{!! route('staff.staff.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>