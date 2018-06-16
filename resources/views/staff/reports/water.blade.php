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
				if (tooltipItems.yLabel > 1000) {
	            	var total = (tooltipItems.yLabel/1000).toFixed(2);
	            	return parseFloat(total)+' litro(s)';
	          	}
	          
	         	return tooltipItems.yLabel+'ml';
			};

			loaderPresent();
			$.ajax({
				dataType: "json",
				url: '{!! route("staff.report.water") !!}',
				data: this.form,
				success: function(waters) {
					var data = this.toChartJs(waters);
					reports.drawChart(data);
				}.bind(this),
				complete: loaderDismiss
			});
		},


		toChartJs: function(waters)
		{
		    var grouped = {};
		    var data = [];
		    var momentDate = moment(this.form.date, 'DD/MM/YYYY');
		    var labels = reports.getTimeLabels(momentDate, this.form.view);

		    $.each(waters, function(i, water) {
		      var time = reports.getTimeLabel(water.created_at, this.form.view);
		      grouped[time] = water.total;
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
					label: 'Água',
					backgroundColor: color.background,
					borderColor: color.border
				}]
		    };
		},
	};
</script>
@endsection