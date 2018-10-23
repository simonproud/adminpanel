<template>
    <div id="parsepanel">
        <b-form @submit="onSubmit" name="IMPORT" >
            <b-form-select v-model="selected" @change="setData" :options="theader" class="mb-3 text-inverse" />
            <b-table show-empty foot-clone
                     stacked="md"
                     :items="import_data"
                     :fields="hfields"
            >
                <template v-for="item in tfooter" :slot="item" slot-scope="row">
                    <b-form-select v-model="tempdata[item]" :name="item" :options="fields" class="mb-3 text-inverse"></b-form-select>
                </template>
            </b-table>
            <b-button type="submit">Submit</b-button>
        </b-form>
    </div>
</template>

<script>
    import JQuery from 'jquery'
    import 'jquery-slimscroll'
    import 'sweetalert'
    let $ = JQuery

export default {
	props: ['import_data', 'hasheader', 'import_id', 'filepath', 'ifields', 'hfields', 'tfooter'],
	mounted(){
    	this.theader = Object.keys(this.ifields);

        this.$nextTick(function () {
          this.setSlimscroll();
        })
	},
	data () {
		return {
		selected:'',
		tempdata:{},
		theader: {},
        fields:[],
      // Note 'isActive' is left out and will not appear in the rendered table
		}
	},
    methods:{
	    logs(i){console.log(i);},
	    setData(i){this.fields = this.ifields[i]; console.log(this.fields);},
	    setSlimscroll(){ $("#parsepanel").slimScroll({axis:"both", width: "100%", alwaysVisible:true, height:"320px"});},
        onSubmit (evt) {
            evt.preventDefault();
            axios.post('/api/import/updateImport',
                {
                    item:this.import_id,
                    module:this.selected,
                    fields: JSON.stringify(this.tempdata)
                }, // the data to post
                { headers: {
                        'Content-type': 'application/x-www-form-urlencoded',
                    }
                }).then(function (response) {
                if(response.data.status == "TRUE"){
                    swal("Отлично!", "Вы поставили файл в очередь на импорт!", "success")
                }
            });
        },
    }
}
</script>