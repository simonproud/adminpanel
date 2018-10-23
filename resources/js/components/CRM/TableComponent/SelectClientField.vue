<template>
    <v-select label="id" name="client" :filterable="false" :options="options" placeholder="Выберите клиента" v-model="client" @input="$emit('input', client)" @search="onSearch">
                        <template slot="no-options">
                            Выберите клиента..
                        </template>
                        <template slot="option" slot-scope="option">
                            <div class="d-center text-inverse">
                                {{ option.first_name }} {{ option.second_name }} {{ option.third_name }}
                            </div>
                        </template>
                        <template slot="selected-option" slot-scope="option">
                            <div class="selected d-center">
                                {{ option.first_name }} {{ option.second_name }} {{ option.third_name }}
                            </div>
                        </template>
    </v-select>
</template>

<script>
const items = [];


    export default {
        props:[],
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                options: [],
                client:'',
            }
        },
        computed: {

        },
        methods: {
            onSearch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce(function (loading, search, vm) {
                fetch('http://151.248.113.174/crm/api/get-clients?q='+
                    escape(search)).
                then(function (res) {
                    res.json().then(function (json) {return vm.options = json.items;});
                    loading(false);
                });
            }, 350)
        },
        mounted(){

        },
    }
</script>
<style>
   .dropdown-toggle:after {content: none; }


</style>