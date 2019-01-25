<template>
    <div class="vertical-box">
    <!-- begin wrapper -->
    <div class="wrapper bg-silver-lighter">
        <!-- begin btn-toolbar -->
        <div class="btn-toolbar">
            <div class="btn-group m-r-5">
                <div class="email-checkbox checkbox checkbox-css">
                    <input class="email-checkbox-input" type="checkbox"   id="checkMailAll" >
                    <label for="checkMailAll"></label>
                </div>
            </div>
            <!-- begin btn-group -->
            <div class="btn-group dropdown m-r-5">
                <button class="btn btn-white btn-sm" data-toggle="dropdown">
                    View {{activeflag}} <span class="caret m-l-3"></span>
                </button>
                <ul class="dropdown-menu text-left text-sm">
                    <li  v-for="flag in fullflags" ><a :href="'?flag='+flag.code"><i class="fa fa-circle f-s-10 fa-fw m-r-5"></i> {{flag.code}}</a></li>
                </ul>
            </div>
            <!-- end btn-group -->
            <!-- begin btn-group -->
            <div class="btn-group m-r-5">
                <a href="javascript:location.reload();" class="btn btn-sm btn-white"><i class="fa fa-redo f-s-14 t-plus-1"></i></a>
            </div>
            <!-- end btn-group -->
            <!-- begin btn-group -->
            <div class="btn-group">
                <button class="btn btn-sm btn-white " v-bind:class="{ hide: !this.isCheckedMail }" v-on:click="onMoveToTrash" ><i class="fa t-plus-1 fa-times f-s-14 m-r-3"></i> <span class="hidden-xs">Delete</span></button>
              <!--  <button class="btn btn-sm btn-white " v-bind:class="{ hide: !this.isCheckedMail }" data-email-action="archive"><i class="fa t-plus-1 fa-folder f-s-14 m-r-3"></i> <span class="hidden-xs">Archive</span></button>
                <button class="btn btn-sm btn-white " v-bind:class="{ hide: !this.isCheckedMail }" data-email-action="archive"><i class="fa t-plus-1 fa-trash f-s-14 m-r-3"></i> <span class="hidden-xs">Junk</span></button>-->
            </div>
            <!-- end btn-group -->
            <!-- begin btn-group -->
            <div class="btn-group ml-auto">
                <a :href="prevpageurl" class="btn btn-white btn-sm" v-if="prevPage">
                    <i class="fa fa-chevron-left f-s-14 t-plus-1"></i>
                </a>
                <a :href="nextpageurl" class="btn btn-white btn-sm" v-if="nextPage">
                    <i class="fa fa-chevron-right f-s-14 t-plus-1"></i>
                </a>
            </div>
            <!-- end btn-group -->
        </div>
        <!-- end btn-toolbar -->
    </div>
    <!-- end wrapper -->
    <!-- begin vertical-box-row -->
    <!-- begin vertical-box -->
    <div class="vertical-box-row">
        <!-- begin vertical-box-cell -->
        <div class="vertical-box-cell">
            <!-- begin vertical-box-inner-cell -->
            <div class="vertical-box-inner-cell">
                <!-- begin scrollbar -->
                <div data-scrollbar="true" data-height="100%">
                    <!-- begin list-email -->
                    <ul class="list-group list-group-lg no-radius list-email">
                        <li v-for="message in messages" class="list-group-item " v-bind:class="{ unread: message.flags.seen == 0 }">
                            <div class="email-checkbox checkbox checkbox-css">
                                    <input class="email-checkbox-input" type="checkbox"  v-model="checkedMail" :id="'cssCheckbox1'+message.uid" :value="message.uid">
                                    <label :for="'cssCheckbox1'+message.uid"></label>
                            </div>
                            <a :href="'/mailbox/'+folder+'/show/'+message.uid" class="email-user bg-gradient-blue">
                                <span class="text-white" style="text-transform: uppercase;"></span>
                            </a>
                            <div class="email-info">
                                <a :href="generateLink('/mailbox/'+folder+'/show/'+message.uid)">
                                    <span class="email-time">{{message.date}}</span>
                                    <span class="email-sender">{{message.from[0].mail}}</span>
                                    <span class="email-title">{{message.subject}}</span>
                                    <span class="email-desc">{{message.body}}</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <!-- end list-email -->
                </div>
                <!-- end scrollbar -->
            </div>
            <!-- end vertical-box-inner-cell -->
        </div>
        <!-- end vertical-box-cell -->
    </div>
    <!-- begin wrapper -->
    <div class="wrapper bg-silver-lighter clearfix">
        <div class="btn-group pull-right">
            <a :href="prevpageurl" class="btn btn-white btn-sm" v-if="prevPage">
                <i class="fa fa-chevron-left f-s-14 t-plus-1"></i>
            </a>
            <a :href="nextpageurl" class="btn btn-white btn-sm" v-if="nextPage">
                <i class="fa fa-chevron-right f-s-14 t-plus-1"></i>
            </a>
        </div>
        <div class="m-t-5 text-inverse f-w-600">Всего: {{count}} писем</div>
    </div>
    <!-- end wrapper -->
    </div>
</template>

<script>
//
    export default {
        props:['mails', 'folder', 'count', 'mxflags', 'activeflag', 'page', 'limit'],
        methods:{
            generateLink(data){
                if(this.folder == 'Trash'){return '#'}else{
                return data;
                }
            },
            onMoveToTrash(event){
                event.preventDefault();
                var th = this;
                console.log(th.checkedMail);
                axios.post('/mailbox/'+th.folder+'/set/moveto', {
                    moveto: 'Trash',
                    uids: th.checkedMail
                })
                    .then(function (response) {
                        window.location.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getPageUrl(param = 'thisurl'){
                var rurl = new URL(window.location.href);
                if(param == 'nextpage'){
                    rurl.searchParams.set('page', parseInt(this.page)+1);
                    return rurl.href;
                }
                if(param == 'prevpage'){
                    rurl.searchParams.set('page', this.page-1);
                    return rurl.href;
                }
                return rurl.href;
            }
        },

        data(){
            return {
                messages: JSON.parse(this.mails),
                checkedMail: [],
                fullflags: JSON.parse(this.mxflags),
                nextpageurl: this.getPageUrl('nextpage'),
                prevpageurl: this.getPageUrl('prevpage'),

            }
        },
        computed: {
            isCheckedMail: function () {
                if(this.checkedMail.length > 0){return true;}
                return false;
            },
            nextPage: function () {
                if(((parseInt(this.page) * parseInt(this.limit)) +1) > parseInt(this.count)){return false;}
                else{return true;}
            },
            prevPage: function () {
                if(this.page <= 1){return false;}else{return true;}
            }
        },
        mounted() {
          //  console.log();
        }
    }
</script>
