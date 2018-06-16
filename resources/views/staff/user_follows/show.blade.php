@extends('staff.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Follow
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('staff.user_follows.show_fields')
                    <a href="{!! route('staff.userFollows.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
