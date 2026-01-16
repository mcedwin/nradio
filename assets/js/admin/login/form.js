$(document).ready(function() {
 
     $('.form-login').submit(function() {
         $(this).mysave((data) => document.location = data.redirect);
         return false;
     });

     $(document).on('click', '.recuperar', function() {
        $(this).mydialog(function(dlg) {  }, () => {})
        return false;
    });

 })