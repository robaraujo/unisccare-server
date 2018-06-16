@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Dieta
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($diet, ['route' => ['staff.diets.update', $diet->id], 'method' => 'patch']) !!}

                        @include('staff.diets.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection