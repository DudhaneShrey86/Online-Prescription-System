
$(document).ready(function(){
  $('#profile_link').change(function(){
    if($(this).val() != ""){
      $('#upload_pic_form').submit();
    }
  });
});
