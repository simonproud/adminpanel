<template>
    <form-wizard @on-complete="onComplete" title="" subtitle=""  shape="square" color="orange">
        <tab-content title="Клиент"
                     icon="fa fa-user">
            <a class="btn btn-success text-white" v-on:click="vclient = !vclient">Добавить/выбрать клиента</a><br/><br/>
            <span>{{createclientresult}}</span>

            <div v-if="clientsetted === false">
                <select-client-field @input="setClient" v-if="vclient === false"></select-client-field>

                <div  v-if="vclient === true">
                    <client-create included="true" wizard="true"  @change="changeClient"></client-create>
                </div>
            </div>
        </tab-content>

    </form-wizard>
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