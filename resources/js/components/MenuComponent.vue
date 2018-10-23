<template>
    <li class="has-sub active">
        <a href="javascript:;">
            <b class="caret"></b>
            <i class="fa fa-th-large"></i>
            <span>Dashboard</span>
        </a>
        <ul class="sub-menu">
            <li class="active"><a href="index.html">Dashboard v1</a></li>
            <li><a href="index_v2.html">Dashboard v2</a></li>
        </ul>
    </li>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
