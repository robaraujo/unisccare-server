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
				return tooltipItems.yLabel+'kg';
			};

			loaderPresent();
			$.ajax({
				dataType: "json",
				url: '{!! route("staff.report.weight") !!}',
				data: this.form,
				success: function(weights) {
					var data = this.toChartJs(weights);
					reports.drawChart(data);
				}.bind(this),
				complete: loaderDismiss
			});
		},


		toChartJs: function(weights)
		{
		    var grouped = {};
		    var data = [];
		    var momentDate = moment(this.form.date, 'DD/MM/YYYY');
		    var labels = reports.getTimeLabels(momentDate, this.form.view);

		    $.each(weights, function(i, weight) {
		      
		      var time = reports.getTimeLabel(weight.created_at, this.form.view);
		      grouped[time] = weight.weight;

		    }.bind(this));

		    // put grouped data in chats.js format
		    $.each(labels, function(i, time) {
		      var last = data[i-1] || 0;
		      var total = grouped[time] || last;
		      data.push(total);
		    });
		    data = this.fixZeroWeights(data);

		    var color = reports.getColor();
		    return {
		    	labels: labels,
				datasets: [{
					data: data,
					label: 'Peso',
					backgroundColor: color.background,
					borderColor: color.border
				}]
		    };
		},

		fixZeroWeights(data) {
			var firstWeightIndex = data.lastIndexOf(0)+1;
		    if (firstWeightIndex !== 0) {
		    	var firstWeight = data[firstWeightIndex];
		    	for (var i=firstWeightIndex; i>=0; i--) {
		    		data[i] = firstWeight;
		    	}
		    }

		    return data;
		}
	};
</script>
@endsection