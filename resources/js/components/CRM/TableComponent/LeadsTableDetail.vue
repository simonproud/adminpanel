<template>
    <b-container fluid>
        <div class="btn-group">
            <b-button :href="'/crm/orders/create?lead='+item.item.id+'&contact=1&client=1'" variant="outline-success">Создать заказ + клиент + контакт</b-button>
            <a href="#" class="btn btn-outline-success dropdown-toggle"
               data-toggle="dropdown"></a>
            <ul class="dropdown-menu pull-right">
                <li><a :href="'/crm/orders/create?lead='+item.item.id+''" >Создать заказ</a></li>
               <!-- <li><a :href="'/crm/orders/create?lead='+item.item.id+'&client=1'" >Создать заказ + клиент</a></li>
                <li><a :href="'/crm/orders/create?lead='+item.item.id+'&contact=1'">Создать заказ + контакт</a></li> -->
            </ul>
        </div>

        <b-button :href="'/crm/leads/edit?lead='+item.item.id" variant="outline-warning">Редактировать заявку</b-button>
        <b-button variant="outline-danger" @click.prevent="deleteLead($event, item)">Удалить заявку</b-button>
    </b-container>
</template>

<script>
    export default {
        props: ['infoItem'],
        mounted() {

        },
        data() {
            return {
                item: this.infoItem,
            }
        },
        methods: {
            deleteLead(event, item) {
                event.preventDefault();
                var vk = this;
                axios.post('/crm/api/delete-lead',
                    {
                        id: item.item.id,
                    }).then(function (responce) {

                    if (responce.data.status == 'success') {
                        vk.$emit('deletedrow');
                    }
                });
            },
        }
    }
</script>
