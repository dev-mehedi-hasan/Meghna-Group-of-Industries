require('./bootstrap');

window.Vue = require('vue');


Vue.component('crm-create', require('./components/CrmCreate.vue').default);
Vue.component('ticket-search', require('./components/TicketSearch.vue').default);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app'
});