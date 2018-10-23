<template>
    <b-container fluid>
        <b-form >
            <input type="hidden" name="_token" :value="csrf">
            <b-row>

                <b-col md="12"><input type="text" name="name" class="form-control" placeholder="Название заявки" v-model="aname"></b-col>
            </b-row>
            <br/>
            <b-row>

                <b-col md="6"><input type="text" name="cost" class="form-control" placeholder="Стоимость заявки" v-model="acost">
                    <br/>
                    <v-select class="text-inverse" label="label" name="operator" :options="users" placeholder="Выберите ответственного" v-model="auser"> <template slot="option" slot-scope="option">
                        {{ option.label }}
                    </template></v-select>
                    <div class="checkbox checkbox-css m-b-20">
                        <input type="checkbox" name="active" v-model="aactive" id="nf_checkbox_css_1">
                        <label for="nf_checkbox_css_1">Active</label>
                    </div>
                </b-col>
                <b-col md="6">
                    <textarea class="form-control" rows="5" name="description" placeholder="Описание" v-model="adescription"></textarea>
                  <br/>

                        <select-client-field @input="setClient" v-if="vclient === false"></select-client-field>
                        <div  v-if="vclient === true">
                                <client-create></client-create>
                        </div>
                </b-col>
            </b-row>
            <hr>
            <b-row>
                <div class="col-md-6"  v-for="field in cstmf">
                    <input :type="field.type" v-model="additional[field.code]" :name="'additional['+field.code+']'" class="form-control" :placeholder="field.description">
                </div>
            </b-row>
            <hr>
            <b-row>
                <b-col md="6">

                    <b-button class="btn btn-success" @click.stop="submitData" >Сохранить</b-button>
                </b-col>
            </b-row>


        </b-form>
    </b-container>
</template>

<script>
const items = [];


    export default {
        props:['userslist', 'cstmfields', 'lead', 'req'],
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                acost: '',
                aname: '',

                getr: JSON.parse(this.req),
                glead: {},
                aclient: '',
                adescription: '',
                aactive: true,
                vclient: false,
                vcontact: false,
                auser: '',
                additional:{},
                users: JSON.parse(this.userslist),
                cstmf: JSON.parse(this.cstmfields),
            }
        },
        computed: {

        },
        methods: {
           setClient(client){
                if(client){
                   this.aclient = client.id;
                }
            },
            submitData(){
                var th = this;
                 axios.post('/api/crm/create-order', {
                    name: th.aname,
                    description: th.adescription,
                    user: th.auser,
                    currency: 'rub',
                    status_id: '0',
                    active: th.aactive,
                    client_id: th.aclient,
                    cost: th.acost,
                    additional: th.additional,
                })
                    .then(function (response) {
                       if(response.data.status == 'success'){
                           window.location.href = '/crm/orders';
                       }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

        },
        mounted(){
            if(this.getr.client == 1){
                this.vclient = true;
            }
            console.log(this.getr);
            if(this.lead != false){
                this.glead = JSON.parse(this.lead);

            }
        }
    }
</script>
<style>

</style>