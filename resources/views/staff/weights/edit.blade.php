@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Weight
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($weight, ['route' => ['staff.weights.update', $weight->id], 'method' => 'patch']) !!}

                        @include('staff.weights.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection