@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Water
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($water, ['route' => ['staff.waters.update', $water->id], 'method' => 'patch']) !!}

                        @include('staff.waters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection