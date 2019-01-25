<template>
    <!-- begin vertical-box -->
    <div class="vertical-box with-grid inbox">
        <!-- begin vertical-box-column -->
       <!-- <div class="vertical-box-column width-200 bg-silver hidden-xs">

            <div class="vertical-box">

                <div class="wrapper bg-silver text-center">
                    <a href="email_compose.html" class="btn btn-inverse p-l-40 p-r-40 btn-sm">
                        Compose
                    </a>
                </div>
             
                <div class="vertical-box-row">

                    <div class="vertical-box-cell">

                        <div class="vertical-box-inner-cell">

                            <div data-scrollbar="true" data-height="100%">

                                <div class="wrapper p-0">
                                    <div class="nav-title"><b>FOLDERS</b></div>
                                    <ul class="nav nav-inbox">
                                        <li class="active"><a href="email_inbox.html"><i class="fa fa-inbox fa-fw m-r-5"></i> Inbox <span class="badge pull-right">52</span></a></li>
                                        <li><a href="email_inbox.html"><i class="fa fa-flag fa-fw m-r-5"></i> Important</a></li>
                                        <li><a href="email_inbox.html"><i class="fa fa-envelope fa-fw m-r-5"></i> Sent</a></li>
                                        <li><a href="email_inbox.html"><i class="fa fa-pencil-alt fa-fw m-r-5"></i> Drafts</a></li>
                                        <li><a href="email_inbox.html"><i class="fa fa-trash fa-fw m-r-5"></i> Trash</a></li>
                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>-->
        <!-- end vertical-box-column -->
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column bg-white">
            <!-- begin vertical-box -->
            <div class="vertical-box">
                <!-- begin wrapper -->
                <div class="wrapper bg-silver">
					<span class="btn-group m-r-5">
						<button form="form-compose" type="submit" class="btn btn-white btn-sm"><i class="fa fa-envelope f-s-14 m-r-3 m-r-xs-0 t-plus-1"></i> <span class="hidden-xs">Send</span></button>
						<!--<a href="javascript:;" class="btn btn-white btn-sm"><i class="fa fa-paperclip f-s-14 m-r-3 m-r-xs-0 t-plus-1"></i> <span class="hidden-xs">Attach</span></a> Задел для беты-->
					</span>
                    <span class="dropdown">
						<a href="javascript:;" class="btn btn-white btn-sm" data-toggle="dropdown"><i class="fa fa-ellipsis-h f-s-14 t-plus-1"></i></a>
						<ul class="dropdown-menu dropdown-menu-left">
							<li><a href="javascript:;">Save draft</a></li>
							<li><a href="javascript:;">Show From</a></li>
							<li><a href="javascript:;">Check names</a></li>
							<li><a href="javascript:;">Switch to plain text</a></li>
							<li><a href="javascript:;">Check for accessibility issues</a></li>
						</ul>
					</span>
                    <span class="pull-right">
						<a href="/mailbox" class="btn btn-white btn-sm"><i class="fa fa-times f-s-14 m-r-3 m-r-xs-0 t-plus-1"></i> <span class="hidden-xs">Отменить</span></a>
					</span>
                </div>
                <!-- end wrapper -->
                <!-- begin vertical-box-row -->
                <div class="vertical-box-row bg-white">
                    <!-- begin vertical-box-cell -->
                    <div class="vertical-box-cell">
                        <!-- begin vertical-box-inner-cell -->
                        <div class="vertical-box-inner-cell">
                            <!-- begin scrollbar -->
                            <div data-scrollbar="true" data-height="100%" class="p-15">
                                <!-- begin email form -->
                                 <b-form @submit="onSubmit" id="form-compose">
                                    <!-- begin email to -->
                                    <div class="email-to">
										<span class="float-right-link">
											<a href="#" data-click="add-cc" data-name="Cc" class="m-r-5">Cc</a>
											<a href="#" data-click="add-cc" data-name="Bcc">Bcc</a>
										</span>
                                        <input-tag v-model="mailto" style="width: 90%;" class="primary" placeholder="Кому:" validate="email"></input-tag>

                                    </div>
                                    <!-- end email to -->

                                    <div data-id="extra-cc"></div>
                                    <div data-id="extra-bcc"></div>

                                    <!-- begin email subject -->
                                    <div class="email-subject">
                                        <input type="text" class="form-control form-control-lg" v-model="subject" placeholder="Тема"  />
                                    </div>
                                    <!-- end email subject -->
                                    <!-- begin email content -->
                                    <div class="email-content p-t-15">
                                        <vue-editor v-model="text"></vue-editor>
                                    </div>
                                    <!-- end email content -->
                                </b-form>
                                <!-- end email form -->
                            </div>
                            <!-- end scrollbar -->
                        </div>
                        <!-- end vertical-box-inner-cell -->
                    </div>
                    <!-- end vertical-box-cell -->
                </div>
                <!-- end vertical-box-row -->
                <!-- begin wrapper -->
                <div class="wrapper bg-silver text-right">
                    <button type="submit" class="btn btn-white p-l-40 p-r-40 m-r-5">Отменить</button>
                    <button type="submit" form="form-compose" class="btn btn-primary p-l-40 p-r-40">Отправить</button>
                </div>
                <!-- end wrapper -->
            </div>
            <!-- end vertical-box -->
        </div>
        <!-- end vertical-box-column -->
    </div>
</template>

<script>
    import InputTag from 'vue-input-tag'
    Vue.component('input-tag', InputTag)

    import { VueEditor, Quill } from 'vue2-editor'

    export default {
        methods:{
            onSubmit(event){
                event.preventDefault();
                var th = this;
                axios.post('/mailbox/send', {
                    mailto:th.mailto,
                    subject:th.subject,
                    text:th.text,

                })
                    .then(function (response) {

                        if(response.data.status == 'success'){

                                window.location.href = '/mailbox';

                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },
        components: {
            VueEditor
        },
        data(){
            return {
                mailto: [],
                text: '',
                subject: '',
            }
        },
        computed: {

        },
    }
</script>
