@extends('staff.layouts.app')

@section('content')
	@include('staff.reports.fields', ['is_food'=> true])
@endsection

@section('scripts')
<script type="text/javascript" src="{!! url('/js/reports.js') !!}"></script>
<script type="text/javascript">
	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy',
	});

	var graph = {
		
		form: {},
		chartjs: null,

		nutrients: {
			protein: 'Proteína',
			carb: 'Carboidrato',
			satured_fat: 'Gord Saturada',
			trans_fat: 'Gord Trans',
			total_fat: 'Gord Total',
			fiber: 'Fibras',
			sodium: 'Sódio',
			iron: 'Ferro',
			calcium: 'Cálcio',
		},

		search: function()
		{
			this.form = {
				type: $('#type').val(),
				view: $('#view').val(),
				type: $('#type').val(),
				date: $('#date').val(),
				user_id: $('#user_id').val(),
			};

			// update tooltip hover
			reports.tooltipLabelFc = function(tooltipItems, data) {
				var prefix = data.datasets[tooltipItems.datasetIndex].label+': ';
	         	var suffix = tooltipItems.yLabel;
	  		
				if (this.form.type === 'nutrient') {
					if (tooltipItems.yLabel > 1000) {
					  var total = (tooltipItems.yLabel/1000).toFixed(2);
					  suffix = parseFloat(total)+' g';
					} else {
					  suffix = tooltipItems.yLabel + ' mg';
					}

					return prefix+': '+suffix;
				}

				return suffix+'x '+prefix;
			}.bind(this)

			loaderPresent();
			$.ajax({
				dataType: "json",
				url: '{!! route("staff.report.food") !!}',
				data: this.form,
				success: function(foods) {
					var data = this.toChartJs(foods);
					reports.drawChart(data);
				}.bind(this),
				complete: loaderDismiss
			});
		},


		toChartJs: function(foods)
		{
			var grouped = {};
			var lineChartData = [];
			var momentDate = moment(this.form.date, 'DD/MM/YYYY');
			var labels = reports.getTimeLabels(momentDate, this.form.view);

			$.each(foods, function(i) {
			  this.preCategorize(grouped, foods[i]);
			}.bind(this));

			// put grouped data in chats.js format
			$.each(grouped, function(groupAttr, val) {
			  var data = [];

			  $.each(labels, function(i, time) {
			    var total = grouped[groupAttr][time] || 0;
			    data.push(total);
			  });

			  var color = reports.getColor();
			  lineChartData.push({
			  	data: data,
			  	label: groupAttr,
			  	backgroundColor: color.background,
				borderColor: color.border
			  });

			}.bind(this));

			return {
		    	labels: labels,
				datasets: lineChartData
		    };
		},

		/**
		 * Create an obj in the following formats:
		 *   food: {food1: {time1: qtt, time2: qtt}, food2: {time1: qtt, time2: qtt}}
		 *   nutrients: {food1: {'Proteína': qtt, time2: qtt}, Carboidrato: {time1: qtt, time2: qtt}}
		 * @param grouped 
		 * @param food 
		 * @param time 
		*/
		preCategorize: function(grouped, food) {

			var time = reports.getTimeLabel(food.created_at, this.form.view);

			if (this.form.type === 'food') {
			  var groupAttr = food.name+' '+food.portion+food.unity;
			  // group by food
			  if (!grouped[groupAttr]) {
			    grouped[groupAttr] = {};
			  }

			  grouped[groupAttr][time] = food.total;
			  return grouped;
			}

			// form type nutrients
			$.each(this.nutrients, function(nutrient) {
			  var groupAttr = this.nutrients[nutrient];
			  
			  // group by food
			  if (!grouped[groupAttr]) {
			    grouped[groupAttr] = {};
			  }

			  if (!grouped[groupAttr][time]) {
			    grouped[groupAttr][time] = 0;
			  }

			  grouped[groupAttr][time] += food[nutrient] * food.total;
			}.bind(this));

			return grouped;
		},
	};
</script>
@endsection