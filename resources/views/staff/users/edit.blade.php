@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Usuário
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($user, ['route' => ['staff.users.update', $user->id], 'method' => 'patch']) !!}

                        @include('staff.users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection