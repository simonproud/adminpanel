<template>
    <v-select label="id" name="client" :filterable="false" :options="options" placeholder="Выберите контакт" v-model="client" @input="$emit('input', client)" @search="onSearch">
                        <template slot="no-options">
                            Выберите контакт...
                        </template>
                        <template slot="option" slot-scope="option">
                            <div class="d-center text-inverse">
                                {{ option.contact_type }} {{ option.data }}
                            </div>
                        </template>
                        <template slot="selected-option" slot-scope="option">
                            <div class="selected d-center">
                                {{ option.contact_type }} {{ option.data }}
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
                fetch('https://homemarketing.ru/crm/api/get-contacts?q='+
                    search).
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