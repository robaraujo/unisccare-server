@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Forum
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'staff.forums.store']) !!}

                        @include('staff.forums.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
