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
                <div>
                    {!! Form::open(['route' => 'staff.foods.store']) !!}

                        @include('staff.foods.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
