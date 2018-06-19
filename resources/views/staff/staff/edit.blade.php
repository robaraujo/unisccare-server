@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Membro da equipe
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($staff, ['route' => ['staff.staff.update', $staff->id], 'method' => 'patch']) !!}

                        @include('staff.staff.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection