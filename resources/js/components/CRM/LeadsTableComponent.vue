<template>
    <b-container fluid>
        <!-- User Interface controls -->
        <b-row>
            <b-col md="6" class="my-1">
                <b-form-group horizontal label="Filter" class="mb-0">
                    <b-input-group>
                        <b-form-input v-model="filter" placeholder="Поиск" />
                        <b-input-group-append>
                            <b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col md="6" class="my-1">
                <b-form-group horizontal label="Sort" class="mb-0">
                    <b-input-group>
                        <b-form-select v-model="sortBy" :options="sortOptions">
                            <option slot="first" :value="null">-- none --</option>
                        </b-form-select><b-form-select :disabled="!sortBy" v-model="sortDesc" slot="append">
                            <option :value="false">Asc</option>
                            <option :value="true">Desc</option>
                        </b-form-select>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col md="6" class="my-1">
                <b-form-group horizontal label="Sort direction" class="mb-0">
                    <b-input-group>
                        <b-form-select v-model="sortDirection" slot="append">
                            <option value="asc">Asc</option>
                            <option value="desc">Desc</option>
                            <option value="last">Last</option>
                        </b-form-select>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col md="6" class="my-1">
                <b-form-group horizontal label="Per page" class="mb-0">
                    <b-form-input type="number" min="1" :options="pageOptions" v-model.number="perPage" />
                </b-form-group>
            </b-col>
        </b-row>

        <!-- Main table element -->
      <div >
          <b-table show-empty
                 stacked="md"
                 :items="getItems"
                 :fields="fields"
                 :currentPage="currentPage"
                 :per-page="perPage"
                 :filter="filter"
                 :sort-by.sync="sortBy"
                 :sort-desc.sync="sortDesc"
                 :sort-direction="sortDirection"
                 @filtered="onFiltered"
           >
            <template slot="name" slot-scope="row">{{row.value.first}} {{row.value.last}}</template>
            <template slot="isActive" slot-scope="row">{{row.value?'Yes :)':'No :('}}</template>
            <template slot="actions" slot-scope="row">
                <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
                <!--<b-button size="sm" @click.stop="info(row.item, row.index, $event.target)" class="mr-1">
                   Подробно
                </b-button>-->
                <b-button size="sm" @click.stop="row.toggleDetails">
                    {{ row.detailsShowing ? 'Скрыть' : 'Подробно' }}
                </b-button>
            </template>
            <template slot="row-details" slot-scope="row">
                <b-card>
                    <ul>
                        <leads-table-detail @deletedrow="getItems" :infoItem="row"></leads-table-detail>
                    </ul>
                </b-card>
            </template>
        </b-table>
      </div>
        <b-row>
            <b-col md="6" class="my-1">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
            </b-col>
        </b-row>

        <!-- Info modal -->


    </b-container>
</template>

<script>
var items = [];


    export default {
       // props:items,
        data () {
            return {
                items: items,
                fields: [
                    { key: 'id', label: 'ID', sortable: true, sortDirection: 'desc' },
                    { key: 'created_at', label: 'Дата заявки', sortable: true, 'class': 'text-center' },
                //    { key: 'status', label: 'Статус', sortable: true },
                    { key: 'device', label: 'Устройство' },
                    { key: 'description', label: 'Комментарий' },
                    { key: 'order', label: 'Заказ №', sortable: true },
                    { key: 'actions', label: '' }
                ],
                currentPage: 1,
                perPage: 8,
                totalRows: 0,
                pageOptions: 8,
                sortBy: null,
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                modalInfo: { title: '', content: '' }
            }
        },
        computed: {
            sortOptions () {
                // Create an options list from our fields
                return this.fields
                    .filter(f => f.sortable)
                    .map(f => { return { text: f.label, value: f.key } })
            }
        },
        methods: {
            info (item, index, button) {
                this.modalInfo.title = `Заказ №: ${item.id}`
                this.modalInfo.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', 'modalInfo', button)
                console.log(this.$route);
            },
            resetModal () {
                this.modalInfo.title = ''
                this.modalInfo.content = ''
            },
            onFiltered (filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            getItems (ctx = null) {
                // Here we don't set isBusy prop, so busy state will be handled by table itself
                //this.isBusy = true
                var query = '';
                if(ctx != null) {
                     query = '?q=' + JSON.stringify(Object.entries(ctx));
                }
                let promise = axios.get('/crm/api/get-leads'+query )

                return promise.then((data) => {

                    var items = data.data.items
                    this.totalRows = data.data.count
                    // Here we could override the busy state, setting isBusy to false
                    // this.isBusy = false
                    return(items)
                }).catch(error => {
                    // Here we could override the busy state, setting isBusy to false
                    // this.isBusy = false
                    // Returning an empty array, allows table to correctly handle busy state in case of error
                    return []
                })
            },
        }
    }
</script>
