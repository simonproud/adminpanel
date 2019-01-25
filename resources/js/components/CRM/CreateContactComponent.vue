    <template>

        <b-form @submit="onSubmit" action="/crm/api/create-contact" method="POST" v-on:change="$emit('change', [atype, $event.target.value, formnamef])">
            <input type="hidden" name="_token" :value="csrf">
            <select-client-field @input="setClient" class="mt-3"  v-if="tincluded"></select-client-field>
            <v-select :options="options" style="color:#000;" class="mt-3" @change="" name="contact_type" v-model="atype"></v-select>
            <input type="text" v-model="adata" class="form-control mt-3" name="data" :placeholder="'Введите '+atype+''">

                    <input type="submit" class="btn btn-success mt-3" @click.stop value="Сохранить" v-if="ifwizard === false" >
        </b-form>

</template>

<script>
const items = [];


    export default {
        props:['included', 'wizard', 'formname', 'client'],
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                options: [
                    'email',
                    'phone',
                    'link',
                    'social',
                ],
                adata: '',
                formnamef: this.formname,
                ifwizard: false,
                tincluded: true,
                atype: '',
                aclient: this.client,
            }
        },
        computed: {

        },
        methods: {
           setClient(client){
                if(client){
                   this.aclient = client.id;
                   console.log(client);
                }
            },
            onSubmit(event){

                event.preventDefault();
                var th = this;

                 axios.post('/crm/api/create-contact', {
                    client: th.client,
                    type: th.atype,
                    data: th.adata,
                })
                    .then(function (response) {
                        console.log(response)

                           if(th.included == 'true'){
                               th.$emit('newcontact', response);
                           }else{
                               window.location.href = '/crm/contacts';
                           }


                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },

        },
        mounted(){

            if(this.included == 'true'){
                this.tincluded = false;
            }
            if(this.wizard){
                this.ifwizard = this.wizard;
            }

        }
    }
</script>
<style>
    .dropdown-toggle:after {content: none; }

</style>