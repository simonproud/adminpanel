    <template>
    <b-container fluid>
        <b-form @submit="onSubmit" action="/crm/api/create-contact" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <select-client-field @input="setClient" class="mt-3"></select-client-field>
            <v-select :options="options" style="color:#000;" class="mt-3" v-model="atype"></v-select>
            <input type="text" v-model="adata" class="form-control mt-3" :placeholder="'Введите '+atype+''">

                    <input type="submit" class="btn btn-success mt-3" @click.stop value="Сохранить">
        </b-form>
    </b-container>
</template>

<script>
const items = [];


    export default {
        props:[],
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
                atype: '',
                aclient: '',
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
            onSubmit(event){
                event.preventDefault();
                var th = this;
                 axios.post('/crm/api/create-contact', {
                    client: th.aclient,
                    type: th.atype,
                    data: th.adata,
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
        }
    }
</script>
<style>
    .dropdown-toggle:after {content: none; }
    .v-select .open-indicator:before {border-color:#ddd;}
    .v-select .dropdown-toggle * {color:#ddd; }
    .v-select .dropdown-toggle {background: #646569;}

</style>