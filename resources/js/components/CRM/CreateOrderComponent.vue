<template>
    <b-container fluid>
        <b-form >
            <input type="hidden" name="_token" :value="csrf"/>
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
                    <a class="btn btn-success text-white" v-on:click="vclient = !vclient">Добавить/выбрать клиента</a><br/><br/>
                    <span>{{createclientresult}}</span>

                    <div v-if="clientsetted === false">
                        <select-client-field @input="selectClient" v-if="vclient === false"></select-client-field>

                        <div  v-if="vclient === true">

                            <client-create included="true" @newclient="setClient"></client-create>
                        </div>
                    </div>

                </b-col>
                <b-col md="6">
                    <textarea class="form-control" rows="5" name="description" placeholder="Описание" v-model="adescription"></textarea>
                     <br/>
                    <span>{{createcontactresult}}</span>

                    <div v-if="contactsetted === false">
                        <div  v-if="vclient === true">
                            <h4>Создайте контакт</h4>
                            <contact-create included="true" :client="aclient" @newcontact="setContact"></contact-create>
                        </div>
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

import swal from 'sweetalert';

    export default {
        props:['userslist', 'cstmfields', 'lead', 'req'],
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                acost: '',
                aname: '',
                createclientresult: '',
                createcontactresult: '',
                getr: JSON.parse(this.req),
                glead: {},
                aclient: '',
                adescription: '',
                aactive: true,
                clientsetted: false,
                contactsetted: false,
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
           setContact(contact){
               console.log(contact);
               this.createcontactresult = contact.data.contact_type+' создан: '+contact.data.data;
                    this.contactsetted = true;
           },
           selectClient(client){
               if(client){
               this.aclient = client.id;
               this.clientsetted = true;
               this.createclientresult = client.first_name + ' ' + client.second_name + '<' + client.id + '>';
               }
           },
           setClient(client){

                if(client.status == 'success'){
                   this.aclient = client.id;
                   this.clientsetted = true;
                   this.createclientresult = client.first_name + ' ' + client.second_name + '<' + client.id + '>';
                }
            },
            submitData(){
                var th = this;
                if (this.clientsetted == false){
                    swal("Ошибка!", 'Вы не выбрали/создали клиента' , 'error',  {
                        dangerMode: true
                    });
                }else{
                 axios.post('/crm/api/create-order', {
                    name: th.aname,
                    description: th.adescription,
                    user: th.auser,
                    currency: 'rub',
                    active: th.aactive,
                    client_id: th.aclient,
                    cost: th.acost,
                    additional: th.additional,
                })
                    .then(function (response) {
                        console.log(response);
                       if(response.statusText == 'OK'){
                           window.location.href = '/crm/orders';
                       }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            },

        },
        mounted(){
            if(this.getr.client == 1){
                this.vclient = true;
            }
            if(this.getr.contact == 1){
                this.vcontact = true;
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