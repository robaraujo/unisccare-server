@extends('staff.layouts.app')

@section('content')
	@include('staff.reports.fields')
@endsection

@section('scripts')
<script type="text/javascript" src="{!! url('/js/reports.js') !!}"></script>
<script type="text/javascript">
	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy',
	});

	var graph = {
		form: {},
		search: function()
		{
			this.form = {
				view: $('#view').val(),
				date: $('#date').val(),
				user_id: $('#user_id').val(),
			};
			// update tooltip hover
			reports.tooltipLabelFc = function(tooltipItems, data) {
				return tooltipItems.yLabel+' passos';
			};

			loaderPresent();
			$.ajax({
				dataType: "json",
				url: '{!! route("staff.report.step") !!}',
				data: this.form,
				success: function(steps) {
					var data = this.toChartJs(steps);
					reports.drawChart(data);
				}.bind(this),
				complete: loaderDismiss
			});
		},


		toChartJs: function(steps)
		{
		    var grouped = {};
		    var data = [];
		    var momentDate = moment(this.form.date, 'DD/MM/YYYY');
		    var labels = reports.getTimeLabels(momentDate, this.form.view);

		    $.each(steps, function(i, step) {
		      var time = reports.getTimeLabel(step.created_at, this.form.view);
		      grouped[time] = step.total;
		    }.bind(this));

		    // put grouped data in chats.js format
		    $.each(labels, function(i, time) {
		      var total = grouped[time] || 0;
		      data.push(total);
		    });

		    var color = reports.getColor();
		    return {
		    	labels: labels,
				datasets: [{
					data: data,
					label: 'Passos',
					backgroundColor: color.background,
					borderColor: color.border
				}]
		    };
		},
	};
</script>
@endsection