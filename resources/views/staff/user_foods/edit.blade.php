@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Food
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userFood, ['route' => ['staff.userFoods.update', $userFood->id], 'method' => 'patch']) !!}

                        @include('staff.user_foods.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection