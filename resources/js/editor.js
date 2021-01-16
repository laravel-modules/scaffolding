$(function () {
  // Summernote
  $('.textarea').summernote({
    height: 300,
    callbacks: {
      onImageUpload: function (files) {
        let data = new FormData();
        data.append("image", files[0]);
        $.ajax({
          data: data,
          type: 'POST',
          url: '/api/editor/upload',
          cache: false,
          contentType: false,
          processData: false,
          success: url => {
            let image = $('<img>').attr('src', url);
            $(this).summernote("insertNode", image[0]);
          }
        });
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