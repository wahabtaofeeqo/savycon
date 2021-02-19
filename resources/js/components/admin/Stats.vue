<template>
	<div>
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
				url: '/api/visitors',
				collection: {}
			}
		},
		methods: {
			loadVisitorsStat() {

				const loader = this.$loading.show();
				axios.get(this.url).then(response => {
					console.log(response);

					this.fillData(response.data);
					loader.hide();
				}).catch(err => {
					console.log(err);
					loader.hide();
				})
			},

			fillData(data) {
				this.collection = {

			    	labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

			    	datasets: [
			    		{
				          	label: 'Visitor Stats',
				          	backgroundColor: '#f87979',
				          	data: [data[0].total, data[1].total, data[2].total, data[3].total, data[4].total, data[5].total, data[6].total, data[7].total, data[8].total, data[9].total, data[10].total, data[11].total]
				        }
			    	]
				}
			}
		},

		created() {
			this.loadVisitorsStat();
		}
	}
</script>