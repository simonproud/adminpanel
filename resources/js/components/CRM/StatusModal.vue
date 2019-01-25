<template>
    <div class="modal modal-message fade" id="modal-change-status" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Изменить статус на:</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <a  v-for="status in JSON.parse(statuses)" href="javascript:;"  @click="setStatus(status.id)" class="btn btn-white" data-dismiss="modal">{{status.code}}</a>
                </div>
                <div class="modal-footer">
                    Текущий статус: {{actualtxt}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['statuses', 'order', 'actual'],
        mounted() {
            this.actualtxt = this.actualj.code;
            console.log(this.actualj);
        },
        methods: {
            setStatus(status) {
                var th = this;
                console.log(status);
                axios.post('/crm/api/order-set-status', {
                    'status_id': status,
                    'order': this.order
                })
                    .then(function (response) {
                        console.log(response);
                        if(response.statusText == 'OK'){
                          swal('OK');
                            th.actualtxt = response.data.code;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                actualtxt: '',
                actualj: JSON.parse(this.actual),
            }
        }
    }
</script>
