@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Mensagens Automatizadas
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('staff.automated_msgs.show_fields')
                    <a href="{!! route('staff.automatedMsgs.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
