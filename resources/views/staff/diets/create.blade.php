@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Dieta
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body container">
                <div class="row">
                    {!! Form::open(['route' => 'staff.diets.store']) !!}

                        @include('staff.diets.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
