/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    require('admin-lte/plugins/jquery/jquery.min.js')
    require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js')
    require('admin-lte/dist/js/adminlte.min.js')
    // window.Popper = require('popper.js').default;
    // window.$ = window.jQuery = require('jquery');
    global.moment = require('moment');
    // require('bootstrap');
    // require('bootstrap4-duallistbox');
    // require('daterangepicker');
    // require('bootstrap-colorpicker');
    // require('tempusdominus-bootstrap-4');
    // require('bootstrap-switch');
    // require('summernote');
    // require('select2/dist/js/select2.full');
    // require('admin-lte');
} catch (e) {}
