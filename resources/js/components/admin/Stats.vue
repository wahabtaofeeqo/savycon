<template>
	<div>

		<div class="mb-5 col-md-6 mb-5">
			<label for="type">User Statistics</label>
			<select class="form-control" @change="loadStats" v-model="type">
				<option value="weekly">Weekly</option>
				<option value="monthly">Monthly</option>
				<option value="daily">Daily</option>
			</select>
		</div>

		<stat-chart :chart-data="collection" :options="options"></stat-chart>
	</div>
</template>

<script>
	import StatChart from './StatChart.js';
	export default {
		components: {
			StatChart
		},
		data() {
			return {
				url: '/api/visitors/',
				collection: {},
				options: [],

				type: 'monthly',

				monthly: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

				weekly: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],			

				//daily: ['0-3am', '3-6am', '6-9am', '9-12pm', '12-3pm', '3-6pm', '6-9pm', '9-11pm'],

				daily: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
			}
		},
		methods: {
			loadVisitorsStat(type) {

				const loader = this.$loading.show();
				axios.get(this.url + type).then(response => {
					this.prepareData(response.data);
					loader.hide();
				}).catch(err => {
					loader.hide();
				})
			},

			prepareData(data) {

				const prep = {
					type: this.type,
					labels: '',
					data: data
				};

				if (this.type == 'monthly') {
					prep.labels = this.monthly;
					prep.data = [data[0].total, data[1].total, data[2].total, data[3].total, data[4].total, data[5].total, data[6].total, data[7].total, data[8].total, data[9].total, data[10].total, data[11].total];
				}

				if (this.type == 'weekly') {
					prep.labels = this.weekly;
					prep.data = [data[0].total, data[1].total, data[2].total, data[3].total, data[4].total, data[5].total, data[6].total];
				}

				if (this.type == 'daily') {
					prep.labels = this.daily;
					prep.data = [data[0].total, data[1].total, data[2].total, data[3].total, data[4].total, data[5].total, data[6].total, data[7].total, data[8].total, data[9].total, data[10].total, data[11].total];
				}
				
				this.fillData(prep);
			},

			fillData(data) {
				this.collection = {

			    	labels: data.labels,
			    	datasets: [
			    		{
				          	label: 'Visitor Stats',
				          	backgroundColor: '#f87979',
				          	data: data.data
				        },
			    	]
				}
			},

			loadStats: function() {
				this.loadVisitorsStat(this.type);
			}
		},

		created() {
			this.loadVisitorsStat(this.type);
		}
	}
</script>