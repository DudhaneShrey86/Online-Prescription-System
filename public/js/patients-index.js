
function search(v){
  v = v.toLowerCase();
  $('.doctordiv').hide();
  var flag = 0;
  $('.doctordiv').each(function(){
    var name = $(this).find('#name').text().toLowerCase();
    if(name.includes(v)){
      $(this).show();
      flag = 1;
    }
  });
  if(flag == 0){
    $('#noresult').show();
  }
  else{
    $('#noresult').hide();
  }
}

function checkfilters(){
  var speciality = $('#speciality').val() ? $('#speciality').val():null;
  var yrs = $('#yrs').val() ? $('#yrs').val():null;
  if(speciality != null){
    speciality = JSON.parse(speciality);
    speciality.forEach((item, i) => {
      $('[value="'+item+'"]').attr('checked', 'checked');
    });
  }
  if(yrs != null){
    $('[value="'+yrs+'"]').attr('checked', 'checked');
  }
}

$(document).ready(function(){
  $('#search').keyup(function(){
    search($(this).val());
  });
  checkfilters();
});
