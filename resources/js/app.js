/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

//import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import vSelect from 'vue-select'

import 'vue-orgchart/dist/style.min.css'

Vue.component('v-select', vSelect)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('notifications-header', require('./components/NotificationsComponent.vue'));
Vue.component('leads-table-component', require('./components/CRM/LeadsTableComponent.vue'));
Vue.component('clients-table-component', require('./components/CRM/ClientsTableComponent.vue'));
Vue.component('wizard-order-client-contact', require('./components/CRM/WizardOrderClientContact.vue'));
Vue.component('client-create', require('./components/CRM/CreateClientComponent.vue'));
Vue.component('contacts-table-component', require('./components/CRM/ContactsTableComponent.vue'));
Vue.component('lead-create', require('./components/CRM/CreateLeadComponent.vue'));
Vue.component('order-create', require('./components/CRM/CreateOrderComponent.vue'));
Vue.component('contact-create', require('./components/CRM/CreateContactComponent.vue'));
Vue.component('orders-table-component', require('./components/CRM/OrdersTableComponent.vue'));
Vue.component('leads-table-detail', require('./components/CRM/TableComponent/LeadsTableDetail.vue'));
Vue.component('select-client-field', require('./components/CRM/TableComponent/SelectClientField.vue'));
Vue.component('select-contact-field', require('./components/CRM/TableComponent/SelectContactField.vue'));
Vue.component('orders-table-detail', require('./components/CRM/TableComponent/OrdersTableDetail.vue'));
Vue.component('fields-cstm-list', require('./components/CRM/FieldsCstmList'));
Vue.component('mailbox-settings-users', require('./components/Mailbox/MailboxSettingsUsers.vue'));
Vue.component('chart-leads-orders', require('./components/CRM/charts/ChartLeadsOrders.vue'));
Vue.component('status-modal', require('./components/CRM/StatusModal.vue'));


Vue.component('import', require('./components/Import/Import.vue'));





Vue.component('c-structure', require('./components/Structure/StructureComponent.vue'));

Vue.component('m-field-sel', require('./components/Import/SelectModuleFields.vue'));
Vue.component('import-parse-panel', require('./components/Import/ImportParsePanel.vue'));
Vue.component('mango-phone-client-card', require('./components/MangoPhone/MangoPhoneClientModal.vue'));

Vue.component('mailbox-compose', require('./components/Mailbox/MailboxCompose.vue'));
Vue.component('mailbox-inbox', require('./components/Mailbox/MailboxInbox.vue'));



const app = new Vue({
    el: '#page-container'
});
