require('./bootstrap');
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

const lang = document.documentElement.lang.substr(0, 2);

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-Accept-Language'] = lang;

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'X-Accept-Language': lang
    }
});

import Vue from 'vue';
import VueInternationalization from 'vue-i18n';
import Locale from '../../js/vue-i18n-locales.generated';
import FileUploader from 'laravel-file-uploader';

Vue.use(FileUploader);
Vue.use(VueInternationalization);

// or however you determine your current app locale

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('select2', require('../components/Select2Component').default);

const app = new Vue({
    el: '#app',
    i18n
});
require('@ahmed-aliraqi/check-all');

CheckAll.onChange(function (el) {
    if (el.checked) {
        el.closest('tr').classList.add("tw-bg-gray-400");
    } else {
        el.closest('tr').classList.remove("tw-bg-gray-400");
    }
});
(function ($) {

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('#flash-overlay-modal').modal();

    $('.nav-sidebar .nav-treeview .nav-item .active').each((index, el) => {
        $(el).closest('.has-treeview').addClass('menu-open');
    });

})(jQuery);

(function () {
    "use strict";

    var treeviewMenu = $('.app-menu');

    // Toggle Sidebar
    $('[data-toggle="sidebar"]').click(function(event) {
        event.preventDefault();
        $('.app').toggleClass('sidenav-toggled');
    });

    // Activate sidebar treeview toggle
    $("[data-toggle='treeview']").click(function(event) {
        event.preventDefault();
        if(!$(this).parent().hasClass('is-expanded')) {
            treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
        }
        $(this).parent().toggleClass('is-expanded');
    });

    // Set initial active toggle
    $("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

    //Activate bootstrip tooltips
    $("[data-toggle='tooltip']").tooltip();

    $('.treeview-item.active').closest('ul.treeview-menu').closest('li.treeview').addClass('is-expanded');

})();


// Initialization
$(function () {
    var Inputmask = require('inputmask').default;
    // $('.price').mask('9999.999');
    // $(".price").inputmask({ alias : "currency", prefix: '₱ ' });
    Inputmask().mask(document.querySelectorAll("input"));
});
