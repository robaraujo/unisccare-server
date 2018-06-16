<li class="{{ Request::is('medRatings*') ? 'active' : '' }}">
    <a href="{!! route('staff.medRatings.index') !!}"><i class="fa fa-edit"></i><span>Med Ratings</span></a>
</li>

<li class="{{ Request::is('staff*') ? 'active' : '' }}">
    <a href="{!! route('staff.staff.index') !!}"><i class="fa fa-edit"></i><span>Staff</span></a>
</li>

<li class="{{ Request::is('steps*') ? 'active' : '' }}">
    <a href="{!! route('staff.steps.index') !!}"><i class="fa fa-edit"></i><span>Steps</span></a>
</li>

<li class="{{ Request::is('automatedMsgs*') ? 'active' : '' }}">
    <a href="{!! route('staff.automatedMsgs.index') !!}"><i class="fa fa-edit"></i><span>Automated Msgs</span></a>
</li>

<li class="{{ Request::is('msgs*') ? 'active' : '' }}">
    <a href="{!! route('staff.msgs.index') !!}"><i class="fa fa-edit"></i><span>Msgs</span></a>
</li>

<li class="{{ Request::is('diets*') ? 'active' : '' }}">
    <a href="{!! route('staff.diets.index') !!}"><i class="fa fa-edit"></i><span>Diets</span></a>
</li>
<li>
	<a href="{!! url('/staff/logout') !!}"><i class="fa fa-edit"></i><span>Sair</span></a>
</li>
