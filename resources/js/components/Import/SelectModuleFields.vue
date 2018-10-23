<template>
<div>
    <select @change="moduleSelected" v-model="seloptions" v-on:change="$emit('change', $event.target.value)">
        <option v-for="(option, index) in options" v-model="seloptions" >{{index}}</option>
    </select>
</div>
</template>

<script>
    export default {
        props:['fields'],
        data: function(){
          return {
              options: this.fields,
              seloptions: '',
              modelses:'',
          };
        },
        mounted() {
            console.log(this.fields)
        },
        methods: {
            moduleSelected: function () {
                this.modelses = this.options[this.seloptions];
            }
        },


    }
</script>
