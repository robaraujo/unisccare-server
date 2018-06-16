@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Medicine
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userMedicine, ['route' => ['staff.userMedicines.update', $userMedicine->id], 'method' => 'patch']) !!}

                        @include('staff.user_medicines.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection