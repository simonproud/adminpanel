<template>
<div>{{item.id}}</div>
</template>

<script>
    export default {
        props: ['infoItem'],
        mounted() {

        },
        data(){
            return {
                item: this.infoItem,
            }
        }
    }
</script>
