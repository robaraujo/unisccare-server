
<!-- First Name Field -->
<div class="form-group">
    {!! Form::label('first_name', 'Nome:') !!}
    <p>{!! $user->first_name .' '. $user->last_name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- Age Field -->
<div class="form-group">
    {!! Form::label('age', 'Age:') !!}
    <p>{!! $user->age !!}</p>
</div>

<!-- Picture Field -->
<div class="form-group">
    {!! Form::label('picture', 'Picture:') !!}
    <p>{!! $user->picture !!}</p>
</div>

<!-- State Field -->
<div class="form-group">
    {!! Form::label('state', 'State:') !!}
    <p>{!! $user->state !!}</p>
</div>

<!-- City Field -->
<div class="form-group">
    {!! Form::label('city', 'City:') !!}
    <p>{!! $user->city !!}</p>
</div>

<!-- Gender Field -->
<div class="form-group">
    {!! Form::label('gender', 'Gender:') !!}
    <p>{!! $user->gender !!}</p>
</div>

<!-- Bio Field -->
<div class="form-group">
    {!! Form::label('bio', 'Bio:') !!}
    <p>{!! $user->bio !!}</p>
</div>

<!-- Staff Id Field -->
<div class="form-group">
    {!! Form::label('staff_id', 'Staff Id:') !!}
    <p>{!! $user->staff_id !!}</p>
</div>

<!-- Points Field -->
<div class="form-group">
    {!! Form::label('points', 'Points:') !!}
    <p>{!! $user->points !!}</p>
</div>

<!-- First Weight Field -->
<div class="form-group">
    {!! Form::label('first_weight', 'First Weight:') !!}
    <p>{!! $user->first_weight !!}</p>
</div>

<!-- Last Weight Field -->
<div class="form-group">
    {!! Form::label('last_weight', 'Last Weight:') !!}
    <p>{!! $user->last_weight !!}</p>
</div>

<!-- Dt Operation Field -->
<div class="form-group">
    {!! Form::label('dt_operation', 'Dt Operation:') !!}
    <p>{!! $user->dt_operation !!}</p>
</div>
<div style="width: 97%; text-align: center;">
    <div class="list-group">
      <div class="list-group-item active">
        <h4 class="list-group-item-heading">Consumo de Água</h4>
      </div>
      <div class="list-group-item">
          <table class="table">
            <thead>
                <tr>
                    <td>Quantidade</td>
                    <td>Data</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($waters as $water)
                <tr>
                    <td>{!! $water->qtt !!}ml</td>
                    <td>{!! $water->created_at !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item active">
        <h4 class="list-group-item-heading">Pesagens</h4>
      </div>
      <div class="list-group-item">
          <table class="table">
            <thead>
                <tr>
                    <td>Peso</td>
                    <td>Data</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($weights as $weight)
                <tr>
                    <td>{!! $weight->weight !!}kg</td>
                    <td>{!! $weight->created_at !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item active">
        <h4 class="list-group-item-heading">Fotos</h4>
      </div>
      <div class="list-group-item">
        <div class="row-fluid">
            @foreach ($photos as $photo)
            <div class="col-md-6 col-xs-4">
                <div class="image-container" 
                    style="background-image: url({!! url('/img/uploads/', $photo->filename) !!})">
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item active">
        <h4 class="list-group-item-heading">Consumo Alimentos</h4>
      </div>
      <div class="list-group-item">
          <table class="table">
            <thead>
                <tr>
                    <td>Alimento</td>
                    <td>Porções</td>
                    <td>Data</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($foods as $food)
                <tr>
                    <td>{!! $food->food->name !!}</td>
                    <td>{!! $food->qtt !!}x{!! $food->food->portion.$food->food->unity !!}</td>
                    <td>{!! $food->created_at !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item active">
        <h4 class="list-group-item-heading">Ingestão Medicamentos</h4>
      </div>
      <div class="list-group-item">
          <table class="table">
            <thead>
                <tr>
                    <td>Medicamento</td>
                    <td>Data</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($medicines as $medicine)
                <tr>
                    <td>{!! $medicine->medicine->name !!}</td>
                    <td>{!! $medicine->created_at !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
</div>