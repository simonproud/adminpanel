    <template>
    <b-container fluid>
        <b-form @submit="onSubmit" action="/crm/api/create-contact" method="POST" v-on:change="$emit('change', [$event.target.type, $event.target.name, $event.target.value, $event.target.checked])">
            <input type="hidden" name="_token" :value="csrf">
            <input name="first_name" v-model="sfirst_name" class="form-control " placeholder="Введите имя" />
            <input name="second_name" v-model="ssecond_name" class="form-control mt-3" placeholder="Введите фамилию" />
            <input name="third_name" v-model="sthird_name" class="form-control mt-3" placeholder="Введите отчество" />
            <textarea name="desctiption" v-model="sdescription" class="form-control mt-3" placeholder="Описание клиента"></textarea>
            <div class="checkbox checkbox-css m-b-20 mt-3">
                <input type="checkbox" name="active" v-model="sclientactive" id="nf_checkbox_css_1sclientactive">
                <label for="nf_checkbox_css_1sclientactive">Active</label>
            </div>
            <div class="col-md-6"  v-for="field in this.cstmfields">
                <input :type="field.type" :class="'form-control field_'+field.type" :placeholder="field.description" :name="field.code" >
            </div>
            <input type="submit" class="btn btn-success mt-3" @click.stop="onSubmit" value="Сохранить" v-if="ifwizard === false">
        </b-form>
    </b-container>
</template>

<script>
const items = [];


    export default {
        props:['included', 'wizard', 'cstmfields'],
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                ifwizard: false,
                sclientactive: '',
                sfirst_name: '',
                sdescription: '',
                ssecond_name: '',
                sthird_name: '',
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
                 axios.post('/crm/api/create-client', {
                    csrf: th.csrf,
                     first_name: th.sfirst_name,
                     active: th.sclientactive,
                     second_name: th.ssecond_name,
                     third_name: th.sthird_name,
                     description: th.sdescription,
                })
                    .then(function (response) {

                       if(response.data.status == 'success'){
                            if(th.included == 'true'){

                                th.$emit('newclient', response.data);
                            }else{
                                window.location.href = '/crm/clients';
                            }
                       }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

        },
        mounted(){
            if(this.wizard){
              this.ifwizard = this.wizard;
            }
        }
    }
</script>
<style>


</style>