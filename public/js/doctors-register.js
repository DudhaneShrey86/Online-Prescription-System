function setspecialities(){
  var v = $('#specialities').val();
  v = JSON.parse(v);
  var data = {};
  v.forEach((item) => {
    data[item] = null;
  });
  $('#speciality').autocomplete({
    data: data,
  });
}


$(document).ready(function(){
  setspecialities();
});
