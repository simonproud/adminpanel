<template>
    <b-container fluid>
        <b-form @submit="onSubmit" action="/api/crm/create-lead" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <b-row>

                <b-col md="12"><input type="text" name="name" class="form-control" placeholder="Название заявки" v-model="aname"></b-col>
            </b-row>
            <hr>
            <b-row>
                <b-col md="6"><v-select class="text-inverse" label="label" name="operator" :options="users" placeholder="Выберите оператора" v-model="operator"> <template slot="option" slot-scope="option">
                    {{ option.label }}
                </template></v-select>
                </b-col>



                <b-col md="6">
                    <textarea class="form-control" rows="5" name="description" placeholder="Описание" v-model="description"></textarea>
                </b-col>
            </b-row><br/>
            <hr>
            <b-row>
                <div class="col-md-6"  v-for="field in cstmf">
                    <input :type="field.type" v-model="additional[field.code]" :name="'additional['+field.code+']'" class="form-control" :placeholder="field.description">
                </div>
            </b-row>

            <hr><b-row>
                <b-col md="6">
                    <input type="submit" class="btn btn-success" @click.stop value="Сохранить"></b-col>
            </b-row>


        </b-form>
    </b-container>
</template>

<script>
const items = [];


    export default {
        props:['userslist', 'cstmfields', 'idlead'],
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                users: JSON.parse(this.userslist),
                options: [],
                aname: '',
                operator: '',
                description: '',
                additional:{},
                cstmf: JSON.parse(this.cstmfields),
            }
        },
        computed: {

        },
        methods: {

            onSubmit(event){
event.preventDefault();

                //action="/crm/settings/savefield"
                axios.post('/crm/api/create-lead', {
                    name: this.aname,
                    id: this.idlead,
                    operator: this.operator,
                    description: this.description,
                    additional: this.additional

                })
                    .then(function (response) {
                       if(response.data.status == 'success'){
                           window.location.href = '/crm/leads';
                       }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            onSearch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                fetch(
                    'http://80.78.254.54/crm/api/get-clients?q='+search
                ).then(res => {
                    res.json().then(json => (vm.options = json.items));
                    loading(false);
                });
            }, 350)
        },
        mounted(){
            console.log(this.cstmf);
        }
    }
</script>
<style>


</style>