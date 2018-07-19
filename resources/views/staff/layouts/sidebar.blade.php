<aside class="main-sidebar" id="sidebarWrapper" class="collapse">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/img/staffs/'.Auth::guard('staff')->user()->picture) }}" class="rounded-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                @if (!Auth::guard('staff')->user())
                    <p>UniscCARE</p>
                @else
                    <p>{{ Auth::guard('staff')->user()->name}}</p>
                @endif
                
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            @include('staff.layouts.menu')
        </ul>
    
    </section>
</aside>