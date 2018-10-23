<template>
    <li class="dropdown">
        <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
            <i class="fa fa-bell"></i>
            <span class="label" v-if="notifyseen">{{this.count}}</span>
        </a>
        <ul class="dropdown-menu media-list dropdown-menu-right">
            <li class="dropdown-header">NOTIFICATIONS {{this.count}}</li>
            <li class="media" v-for="noti in notifications">
                <a href="javascript:;">
                    <div class="media-left">
                        <i class="fa fa-bug media-object bg-green"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading" v-html="noti.message"><i class="fa fa-exclamation-circle text-danger"></i></h6>
                        <div class="text-muted f-s-11">3 minutes ago</div>
                    </div>
                </a>
            </li>

            <li class="dropdown-footer text-center">
                <a href="javascript:;">View more</a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        props: ['user'],
        created(){

        },
        computed:{

        },
        mounted(){
            if(this.count > 0 ){this.notifyseen = true;}
            if(Laravel.userId) {
                window.Echo.private(`App.User.` + Laravel.userId + ``)
                    .notification((notification) => {
                        console.log(notification.data);
                        this.notifications.push(notification.data);
                        this.count++;
                        if(this.count > 0 ){this.notifyseen = true;}
                    });
            }
        },
        data(){
            return {
                notifications: [],
                count: 0,
                notify: "",
                notifyseen: false,
            }
        }

    }
</script>
