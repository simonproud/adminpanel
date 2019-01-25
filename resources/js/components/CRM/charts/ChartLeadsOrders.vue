<template>
    <div class="small">
        <line-chart :chart-data="datacollection"></line-chart>
    </div>
</template>

<script>
    import LineChart from '../../LineChart.js'

    export default {
        props: ['labels', 'chartdatasets'],
        components: {
            LineChart
        },
        data () {
            return {
                datacollection: null
            }
        },
        mounted () {
            this.fillData()
        },
        methods: {
            fillData () {
                this.datacollection = JSON.parse(this.chartdatasets);
            }
        }
    }
</script>

<style>
    .small  {
     /*   max-width: 500px;
        height: 500px;*/
       /* margin:  150px auto;*/
    }
</style>