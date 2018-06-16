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
                    {!! Form::open(['route' => 'staff.userFoods.store']) !!}

                        @include('staff.user_foods.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
