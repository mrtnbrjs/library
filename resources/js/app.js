/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});





$( document ).ready(function() {

    $('.changeStatus').click( function() {
        var bookID = $(this).data('bookid'); 
        $('#changeStatus').attr('action', window.parent.location.origin + '/book/'+bookID);
        $('.user_id').val(bookID);
    });  


    var table = $('.dataTableBooks').DataTable({
        processing: true,
        serverSide: true,
        bRetrieve: true,
        ajax: window.parent.location.origin +'/dataTableBooks',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'author', name: 'author'},
            {data: 'published_date', name: 'published_date'},
            {data: 'category.name', name: 'category'},
            {data: 'username', name: 'username'},
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
    });
    dataChangeStates(".dataTableBooks tbody", table);
    
});

var dataChangeStates = function(tbody, table) {
    $(tbody).on("click", ".changeStatus", function(){
        var data = table.row( $(this).parents("tr") ).data();
        console.log(data.id);
        var bookID = data.id; 
        $('#changeStatus').attr('action', window.parent.location.origin + '/book/'+bookID);
        $('.user_id').val(bookID);
    });
}


