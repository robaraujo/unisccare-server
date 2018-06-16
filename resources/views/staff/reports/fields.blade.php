<div class="content">
    <div class="row">
        <div class="form-group col-sm-5">
            {!! Form::label('view', 'Período:') !!}
            {!! Form::select('view', [
            'year'=>'Anual',
            'month'=>'Mensal',
            'week'=>'Semanal',
            'day'=>'Diário',
            ], 'month', ['class' => 'form-control', 'id'=> 'view']) !!}
        </div>
        @if (isset($is_food))
        <div class="form-group col-sm-5">
            {!! Form::label('type', 'Tipo:') !!}
                {!! Form::select('type', [
                        'nutrient'=>'Nutrientes',
                        'food'=>'Alimentos',
                    ], null, ['class' => 'form-control', 'id'=> 'type']) !!}
        </div>
        @endif
        <div class="form-group col-sm-5">
            {!! Form::label('user_id', 'Usuário:') !!}
            {!! Form::select('user_id', $users, null, 
                ['required'=> true, 'class' => 'form-control', 'id'=> 'user_id']
            )!!}
        </div>
        <div class="form-group col-sm-5">
            {!! Form::label('user_id', 'Data:') !!}
            <input id="date" class="form-control datepicker" type="text" name="date" value="{!! date('d/m/Y') !!}" />
        </div>

        <div class="btn-inline form-group col-sm-2">
            <button onclick="graph.search()" class="btn btn-primary">Buscar</button>
        </div>
    </div>
    <canvas id="chart" width="400" height="100"></canvas>
</div>