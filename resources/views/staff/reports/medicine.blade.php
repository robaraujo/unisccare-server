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
				var prefix = data.datasets[tooltipItems.datasetIndex].label+': ';
				var suffix = tooltipItems.yLabel;

				return prefix + suffix;
			};

			loaderPresent();
			$.ajax({
				dataType: "json",
				url: '{!! route("staff.report.medicine") !!}',
				data: this.form,
				success: function(medicines) {
					var data = this.toChartJs(medicines);
					reports.drawChart(data);
				}.bind(this),
				complete: loaderDismiss
			});
		},


		toChartJs: function(medicines)
		{
		    var grouped = {};
		    var data = [];
		    var momentDate = moment(this.form.date, 'DD/MM/YYYY');
		    var labels = reports.getTimeLabels(momentDate, this.form.view);

		    $.each(medicines, function(i, medicine) {
		     	let time = reports.getTimeLabel(medicine.created_at, this.form.view);
			    let groupAttr = medicine.name;

			    // group by medicine
			    if (!grouped[groupAttr]) {
			      grouped[groupAttr] = {};
			    }

			    grouped[groupAttr][time] = medicine.total;
		    }.bind(this));

		    // put grouped data in chats.js format
		    $.each(grouped, function(groupAttr) {

				// put grouped data in chats.js format
				var group = [];
				$.each(labels, function(i, time) {
					var total = grouped[groupAttr][time] || 0;
					group.push(total);
				});

				var color = reports.getColor();
		      	data.push({
			      	data: group,
			      	label: groupAttr,
			      	backgroundColor: color.background,
					borderColor: color.border
		      	});
		    });
		    
		    return {
		    	labels: labels,
				datasets: data
		    };
		},
	};
</script>
@endsection