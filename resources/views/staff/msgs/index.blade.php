@extends('staff.layouts.app')

@section('content')
<div id="chat" class="container-fluid" style="display: none;">
	
	<div class="clearfix"></div>
	<div class="row">
		<!-- users container -->
		<div class="col-4 p-0 container-left noselect text-white">
			<div class="container-header input-group p-2">
				<input data-bind="value: searchQuery, valueUpdate: 'afterkeydown'" type="text" class="search-user p-2" placeholder="Procurar paciente" aria-describedby="basic-addon1">
			</div>
			<div data-bind="foreach: filteredEntries()" class="container">
				<div data-bind="click: chatApp.selectUser.bind(chatApp, $data), css: {active: id == chatApp.slUser.id()}" class="row cpointer row-client">
					<div class="col-4 col-sm-3 col-lg-2 p-0">
						<img class="user-img p-2" data-bind='attr: {src: chatApp.getPicture($data.picture, "users")}'/>
					</div>
					<div class="col-8 col-sm-9 col-lg-10 mt-2">
						<div class="chat-client-name">
							<span data-bind="text: first_name"></span>
							<span class="d-none d-md-inline-block" data-bind="text: last_name"></span>
						</div>
						<small class="chat-last-msg" data-bind="text: $data.last_msg ? $data.last_msg.content : ''"></small>
					</div>
				</div>
			</div>
		</div>
		<!-- messages container -->
		<div class="col-8 container-right p-0">
			<div data-bind="if: slUser.id()">
				<div class="container-header container text-white">
					<div class="row">
						<div class="col-4 col-sm-2 col-lg-1">
							<img class="user-img p-2" data-bind='attr: {src: chatApp.getPicture(slUser.picture(), "users")}'/>
						</div>
						<div class="col-8 col-sm-10 col-lg-11 pt-3 pl-md-4">
							<span data-bind="text: slUser.first_name()+' '+slUser.last_name()" class="chat-user-name"></span>
							<div class="dropdown pull-right">
								<i class="fa fa-ellipsis-v p-1 cpointer" data-toggle="dropdown"></i>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a data-bind="attr: {href: '/staff/users/'+slUser.id()}" class="dropdown-item" href="#">Ver Perfiil</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container-right-content">
					<div class="container container-msgs" data-bind="foreach: messages()">
						<div class="msg from-user" data-bind="if: from === 'user'">
							<div class="row mt-2">
								<div class="col-1">
									<img class="user-img" data-bind="attr: {src: chatApp.getPicture($parent.slUser.picture(), 'users')}">
								</div>
								<div class="col-9 pl-5">
									<div class="msg-text bg-light">
										<div data-bind="text: content"></div>
										<div class="triangle"></div>
										<div class="timeago" data-bind="timeago: created_at"></div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="msg from-staff" data-bind="if: from === 'staff'">
							<div class="row mt-2">
								<div class="offset-sm-2 col-8 col-xs-7 pr-0">
									<div class="msg-text pull-right bg-primary text-white">
										<span data-bind="text: content"></span>
										<span data-bind="if: $data.sending">
											<i class="fa fa-spinner fa-spin"></i>
										</span>
										<div class="triangle bg-primary"></div>
										<div class="timeago" data-bind="timeago: created_at"></div>
									</div>
								</div>
								<div class="col-2 col-xs-5">
									<img class="user-img" data-bind="attr: {src: chatApp.getPicture(CONFIG.staff.picture, 'staffs')}">
								</div>
							</div>
						</div>
					</div>
					<div class="container-send-msg pt-2">
						<input class="d-block p-2 pr-5" data-bind="value: msgToSend, valueUpdate: 'afterkeydown',  enterkey: sendMsg" type="text">
						<i data-bind="click: sendMsg" class="btn-send-msg fa fa-paper-plane bg-primary text-white rounded-circle p-2"></i>
					</div>
				</div>
			</div>
			<div class="no-chat center mt-5" data-bind="if: !slUser.id()">
				<img class="mr-auto rounded-circle img-fluid" data-bind="attr: {src: getPicture(CONFIG.staff.picture, 'staffs')}">
				<div class="mx-4">
					<div class="title1">Mantenha seus pacientes sempre informados</div>
					<hr>
					<div class="daily-word"><b>"</b>Frase inpiradora diária aqui<b>"</b></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<link rel="stylesheet" href="{!! url('/css/chat.css') !!}"></link>
@section('scripts')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.2/knockout-min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/knockout.mapping/2.4.1/knockout.mapping.min.js"></script>
	<script type="text/javascript" src="{!! url('/js/knockout-helpers.js') !!}"></script>
	<script type="text/javascript" src="{!! url('/js/chat.js') !!}"></script>
@endsection