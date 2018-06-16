
<li class="{{ Request::is('staff/users*') ? 'active' : '' }}">
    <a href="{!! route('staff.users.index')!!}"><i class="fa fa-user"></i><span>Usuários</span></a>
</li>

<li  class="{{ Request::is('staff/report*') ? 'active' : '' }} treeview">
  <a href="#">
    <i class="fa fa-area-chart"></i> <span>Relatórios</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="{{ Request::is('staff/report/food') ? 'active' : '' }}">
        <a href="{!! route('staff.report.food') !!}"><span>Alimentação</span></a>
    </li>
    <li class="{{ Request::is('staff/report/weight') ? 'active' : '' }}">
        <a href="{!! route('staff.report.weight') !!}"><span>Pesos</span></a>
    </li>
    <li class="{{ Request::is('staff/report/water') ? 'active' : '' }}">
        <a href="{!! route('staff.report.water') !!}"><span>Água</span></a>
    </li>
    <li class="{{ Request::is('staff/report/step') ? 'active' : '' }}">
        <a href="{!! route('staff.report.step') !!}"><span>Passos</span></a>
    </li>
    <li class="{{ Request::is('staff/report/medicine') ? 'active' : '' }}">
        <a href="{!! route('staff.report.medicine') !!}"><span>Medicamentos</span></a>
    </li>
  </ul>
</li>


<li class="{{ Request::is('staff/automatedMsgs*') ? 'active' : '' }}">
    <a href="{!! route('staff.msg.index') !!}"><i class="fa fa-comment"></i><span>Conversas</span></a>
</li>

<li class="{{ Request::is('staff/automatedMsgs*') ? 'active' : '' }}">
    <a href="{!! route('staff.automatedMsgs.index') !!}"><i class="fa fa-envelope"></i><span>Msgs Automatizadas</span></a>
</li>

<li class="{{ Request::is('staff/diets*') ? 'active' : '' }}">
    <a href="{!! route('staff.diets.index')!!}"><i class="fa fa-cutlery"></i><span>Dietas</span></a>
</li>


<li class="{{ Request::is('staff/foods*') ? 'active' : '' }}">
    <a href="{!! route('staff.foods.index') !!}"><i class="fa fa-apple"></i><span>Alimentos</span></a>
</li>

<li class="{{ Request::is('staff/medicines*') ? 'active' : '' }}">
    <a href="{!! route('staff.medicines.index') !!}"><i class="fa fa-medkit"></i><span>Medicamentos</span></a>
</li>

<li class="{{ Request::is('staff/schedules*') ? 'active' : '' }}">
    <a href="{!! route('staff.schedules.index') !!}"><i class="fa fa-calendar-o"></i><span>Compromissos</span></a>
</li>

<li class="{{ Request::is('staff/medRatings*') ? 'active' : '' }}">
    <a href="{!! route('staff.medRatings.index') !!}"><i class="fa fa-star-half-o"></i><span>Suas Avaliações</span></a>
</li>
<li>
    <a href="{!! url('/staff/logout') !!}"><i class="fa fa-sign-out"></i><span>Sair</span></a>
</li>