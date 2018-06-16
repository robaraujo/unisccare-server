@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Step
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($step, ['route' => ['staff.steps.update', $step->id], 'method' => 'patch']) !!}

                        @include('staff.steps.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection