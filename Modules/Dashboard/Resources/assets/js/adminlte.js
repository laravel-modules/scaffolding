require('./bootstrap');
(function ($) {

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('#flash-overlay-modal').modal();

    $('.nav-sidebar .nav-treeview .nav-item .active').each((index, el) => {
        $(el).closest('.has-treeview').addClass('menu-open');
    });

})(jQuery);

// Initialization
$(function () {
    let dir = $('html').attr('dir');
    // Initialize Select2 Elements
    $('.select2').select2({
        dir,
    });

    // Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        dir,
    });

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY hh:mm A'
        }
    });
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
        },
        function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
    );

    // Timepicker
    $('#timepicker').datetimepicker({
        format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    // //Colorpicker
    $('.my-colorpicker1').colorpicker()
    // //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function (event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $(function () {
        // Summernote
        $('.textarea').summernote({
            height: 300,
            callbacks: {
                onImageUpload: function (files, editor, welEditable) {
                    console.log(files[0], this);
                }
            },
            placeholder: 'Start typing your text...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['ltr', 'rtl']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
    // Hide filter popover on click outside
    $(document).on('click', 'body', (e) => {
        //did not click a popover toggle or popover
        let isBtn = e.target == $('#filter-popover')[0]
            || e.target.innerHTML == $('#filter-popover').html();
        if (! isBtn && $(e.target).parents('.popover').length === 0) {
            $('#filter-popover').popover('hide');
        }
    });
});
