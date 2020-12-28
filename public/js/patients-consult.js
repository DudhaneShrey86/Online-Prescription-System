var elem = document.getElementById('tabs');
var instance = M.Tabs.getInstance(elem);
$(document).ready(function(){
  $('.longbuttons').click(function(){
    var tabid = $(this).data('id');
    instance.select(tabid);
  });
  $('#accept_consent').change(function(){
    if(this.checked){
      $('#submitbutton').removeAttr('disabled');
    }
    else{
      $('#submitbutton').attr('disabled', 'disabled');
    }
  });
});
