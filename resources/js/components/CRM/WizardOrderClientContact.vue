<template>
    <div>
        <form-wizard @on-complete="onComplete" title="" subtitle=""  shape="square" color="orange">
            <tab-content title="Клиент"
                         icon="fa fa-user">
                <a class="btn btn-success text-white" v-on:click="vclient = !vclient">Добавить/выбрать клиента</a><br/><br/>
                <span>{{createclientresult}}</span>

                <div v-if="clientsetted === false">
                    <select-client-field @input="setClient" v-if="vclient === false"></select-client-field>

                    <div  v-if="vclient === true">
                        <client-create included="true" wizard="true" :cstmfields="this.clientcstmf"  @change="changeClient"></client-create>
                    </div>
                </div>
            </tab-content>
            <tab-content title="Контакт"
                         icon="fa fa-cog">
                <span>{{createcontactresult}}</span>
                <a class="btn btn-success text-white" v-on:click="addContact">Добавить контакт</a><br/><br/>

<b-row>
                    <div  v-if="vcontact === true" v-for="(event, key, index) in contacts">
                        <b-card > <contact-create included="true" :formname="event['id']" wizard="true"  @change="setContact"></contact-create><br/><b-button  variant="danger" v-on:click="removeContact(event, key, index)">Удалить</b-button></b-card>
                    </div>
</b-row>

            </tab-content>
            <tab-content title="Заказ"
                         icon="fa fa-check">
                <b-row>

                    <b-col md="12"><input type="text" name="name" class="form-control" placeholder="Название заявки" @change="setOrder"></b-col>
                </b-row>
                <br/>
                <b-row>

                    <b-col md="6"><input type="text" name="cost" class="form-control" placeholder="Стоимость заявки" @change="setOrder">
                        <br/>
                        <v-select class="text-inverse" label="label" name="operator" :options="users" placeholder="Выберите ответственного" @input="setResl"> <template slot="option" slot-scope="option">
                            {{ option.label }}
                        </template></v-select>
                        <div class="checkbox checkbox-css m-b-20">
                            <input type="checkbox" name="active" @change="setOrder" id="nf_checkbox_css_1">
                            <label for="nf_checkbox_css_1">Active</label>
                        </div>
                    </b-col>
                    <b-col md="6">
                        <textarea class="form-control" rows="5" name="description" placeholder="Описание"  @change="setOrder"></textarea>
                    </b-col>
                </b-row>
                <b-row>
                    <div class="col-md-6"  v-for="field in this.ordercstmf">
                        <input :type="field.type" :class="'form-control field_'+field.type" :placeholder="field.description" :name="field.code" >
                    </div>
                </b-row>
            </tab-content>
            <b-button type="primary" slot="prev" class="btn btn-warning">Назад</b-button>
            <b-button type="primary" slot="next" class="btn btn-default" @click="logthis" >Далее</b-button>
            <b-button type="primary" slot="finish" @click="submitData" class="btn btn-success">Отправить</b-button>
      </form-wizard>
    </div>
</template>

<script>
const items = [];

import swal from 'sweetalert';
import {FormWizard, TabContent} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';

    export default {
        props:['userslist', 'cstmfields', 'leadf', 'req', 'ordercstm', 'clientcstm'],
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                createclientresult: '',
                client: [],
                contacts: [],
                order: [],
                data:{
                    contacts:[],
                  //  client:{},
                    order:[],
                    lead:this.leadf,
                },
                countcontacts: 0,
                clientsetted:false,
                vclient: true,
                contactsetted: false,
                createcontactresult:'',
                vcontact:true,
                ordercstmf:JSON.parse(this.ordercstm),
                clientcstmf:JSON.parse(this.clientcstm),
                users:JSON.parse(this.userslist),
            }
        },
        components: {
            FormWizard,
            TabContent
        },
        computed: {

        },
        methods: {
            logthis(){console.log(this.data)},
            setOrder(event){
                var value = '';
                var name = event.target.name;
                if(event.target.type == 'checkbox'){
                    value = event.target.checked;
                }else{
                    value = event.target.value;
                }
                this.order.push({name:name, value:value});
                this.data['order'] = this.order;
            },
            setResl(event){
                this.order.push({name:'operator', value:event.value});
            },
            addContact(){
                this.countcontacts++;
                this.contacts.push({id: this.countcontacts});

            },
            removeContact(event, key, index){


                console.log(event);
                this.contacts.splice(key, 1);

                console.log(key);

                console.log(index);

            },
            changeClient(event){
                if(event[0] == 'checkbox'){
                    this.client[event['1']] = event[3];
                }else{
                    this.client[event['1']] = event[2];
                }
                this.data['client'] = Object.entries(this.client);
            },
            onComplete: function(){
               console.log(this.data);
            },
           setContact(contact){
               this.contacts[contact[2]-1] = contact;
               this.data['contacts']  = this.contacts;
           },
           setClient(client){
              /*  if(client.status == 'success'){
                   this.aclient = client.id;
                   this.clientsetted = true;
                   this.createclientresult = client.first_name + ' ' + client.second_name + '<' + client.id + '>';
                }*/
            },
            submitData(){
                var th = this;
                if (this.clientsetted != false){
                    swal("Ошибка!", 'Вы не выбрали/создали клиента' , 'error',  {
                        dangerMode: true
                    });
                }else{
                 axios.post('/crm/api/create-wizard', {
                    data: th.data,
                })
                    .then(function (response) {
                       if(response.data.status == 'success'){
                           swal({
                               icon: "success",
                               title:"Заказ создан!",
                               closeOnClickOutside: false,
                               closeOnEsc: false,
                               buttons:{
                                   ok: {
                                       text: "OK",
                                       value: 'ok',
                                   }
                               }
                           }).then((value) => {
                               if(value == 'ok'){
                                   window.location.href = '/crm/orders';
                               }
                           });


                       }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            },

        },
        mounted(){
           console.log(this.clientcstmf);
        }
    }
</script>
<style>

</style>