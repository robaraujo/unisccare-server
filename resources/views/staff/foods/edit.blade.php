@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Alimento
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($food, ['route' => ['staff.foods.update', $food->id], 'method' => 'patch']) !!}

                        @include('staff.foods.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection