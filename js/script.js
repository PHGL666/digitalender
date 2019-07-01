$(document).ready(function() {

  tinymce.init({
    selector: 'textarea'
  });

  $('select').select2();

  $('[data-toggle="tooltip"]').tooltip();

});
