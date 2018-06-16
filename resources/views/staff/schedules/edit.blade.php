@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Compromisso
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($schedule, ['route' => ['staff.schedules.update', $schedule->id], 'method' => 'patch']) !!}

                        @include('staff.schedules.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection