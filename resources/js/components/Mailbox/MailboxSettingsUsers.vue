<template>
          <b-table show-empty
                 stacked="md"
                 :items="items"
                 :fields="fields"
           >
              <template slot="id" slot-scope="row">
                  <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
                {{row.item.id}}
              </template>
            <template slot="actions" slot-scope="row">
                <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
                <b-button :href="'/crm/settings/editfield?q='+row.item.id" class="btn-warning" size="sm" @click.stop="editRow(row.item.id)" >
                   Редактировать
                </b-button>
                <b-button class="btn-danger" size="sm" @click.stop="deleteRow(row)">
                    Удалить
                </b-button>
            </template>

        </b-table>

</template>

<script>
    import JQuery from 'jquery'
    import 'jquery-slimscroll'
    import 'sweetalert'
    let $ = JQuery

    const items = [];


    export default {
        props:['vitems', 'vfields'],
        data () {
            return {
                vimodels: this.vimodel,
                items: this.vitems,
                fields: this.vfields,

                sendeddata: {}
            }
        },
        mounted(){
            console.log(this.vitems);

            this.$nextTick(function () {
         //       this.setSlimscroll();
            })
        },
        computed: {

        },
        methods: {
           // setSlimscroll(){ $(".table").slimScroll({axis:"both", width: "100%", alwaysVisible:true});},
            deleteRow(i){
                var vk = this;
                axios.post('/crm/settings/deletefield',
                    {
                        id: i.item.id,
                        model: this.vimodel,
                    }).then(function (responce) {
                    if(responce.data.status == 'success'){
                        vk.removeRow(i.index);
                    }
                });
                },
            removeRow: function (index) {
                this.items.splice(index, 1);
            },
            editRow(i){console.log(i);},
        }
    }
</script>
