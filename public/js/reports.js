var reports = {
	chartjs: null,
	tooltipLabelFc: null,
	colorsCt: 0,
	colors: [
		[0, 130, 200],
		[230, 25, 75],
		[60, 180, 75],
		[255, 225, 25],
		[245, 130, 48],
		[145, 30, 180],
		[70, 240, 240],
		[0, 128, 128],
		[128, 0, 0],
		[128, 128, 0],
		[255, 215, 180]
	],

	/**
	 * Get possible time labels based on view(day, month, year..) selected
	 */
	getTimeLabels: function(momentDate, view) {
		var labels = [];
		var isThisYear = momentDate.format('YYYY') === moment().format('YYYY');
		var isThisMonth = isThisYear && momentDate.format('MM') === moment().format('MM');
		var isThisWeek = isThisMonth && momentDate.week() === moment().week();
		var isThisDay = isThisMonth && momentDate.format('DD') === moment().format('DD');
		
		var thisHour = moment().format('HH');
		var thisWeekDay = moment().format('ddd');
		var thisDay = moment().format('DD');
		var thisMonth = moment().format('MMM');

		if (view === 'day') {
		  	for (var i=1; i<= 23; i++) {
		  		// do not show hours after actual
		 		if (isThisDay && i > thisHour) {
		 			break;
		 		}

		    	labels.push( ("0" + i).slice(-2) );
			}
		} else if (view === 'week') {

		 	var weekDays = moment.weekdaysShort();

		 	for (var i=0; i<weekDays.length; i++) {
		 		var weekDay = weekDays[i];
		 		labels.push(weekDay);

		 		// do not show months after actual
		 		if (isThisWeek && thisWeekDay === weekDay) {
		 			break;
		 		}
		 	}
		} else if (view === 'month') {


		 	for (var i=1; i<= momentDate.daysInMonth(); i++) {
		 		// do not show days after actual
		 		if (isThisMonth && i > thisDay) {
		 			break;
		 		}

		    	labels.push( ("0" + i).slice(-2) );
		 	}
		} else if (view === 'year') {
		 	var months = moment.monthsShort();

		 	for (var i=0; i<months.length; i++) {
		 		var month = months[i];
		 		labels.push(month);

		 		// do not show months after actual
		 		if (isThisYear && thisMonth === month) {
		 			break;
		 		}
		 	}
		}

		return labels;
	},

	/**
	 * Return x label name. Ex.: 05, 16, Abr
	 * @param food 
	*/
	getTimeLabel: function(date, view) {
		var momentDate = moment(date);
		var time = momentDate.format('HH');

		if (view === 'week') {
		  time = momentDate.format('ddd');
		} else if (view === 'month') {
		  time = momentDate.format('DD');
		} else if (view === 'year') {
		  time = momentDate.format('MMM');
		}

		return time;
	},
	getColor: function() {
		this.colorsCt = (this.colorsCt < this.colors.length) ? this.colorsCt : 0;
		var c = this.colors[this.colorsCt];
		this.colorsCt++;

		return {
			border: 'rgba('+c[0]+','+c[1]+','+c[2]+', 1)',
			background: 'rgba('+c[0]+','+c[1]+','+c[2]+', 0.6)',
		};
	},

	/**
	 * Create or update chart
	 */
	drawChart: function(chartData) {
		if (this.chartjs) {
			this.chartjs.data = chartData;
				return this.chartjs.update();
		}

		var ctx = document.getElementById("chart");
		this.chartjs = new Chart(ctx, {
		    type: 'line',
		    data: chartData,
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        },
		        responsive: true,
			    tooltips: {
			      	enabled: true,
			      	mode: 'single',
			      	callbacks: {
			      		label: this.tooltipLabelFc
			      	}
				}
		    }
		});
	},
};