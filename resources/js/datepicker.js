require('jquery-datetimepicker');

$(function () {
  // jQuery.datetimepicker.setLocale($('html').attr('lang'));

  $('.datepicker').each((i, el) => {
    let datepicker = !! $(el).data('datepicker');
    let format = $(el).data('format') || 'Y/m/d';
    let time = !! $(el).data('time');
    let fromNow = !! $(el).data('from-now');
    $(el).datetimepicker({
      format,
      rtl: $('html').attr('dir') === 'rtl',
      datepicker,
      timepicker: time,
      ampm: true,
      mask: true,
      onShow: function () {
        this.setOptions({
          minDate: $($(el).data('start-element')).val() || (fromNow ? new Date() : false),
        });
      },
    });
  });
});
