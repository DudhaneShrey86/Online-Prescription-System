var prescriptionmodal = document.getElementById('prescriptionmodal');
var instance = M.Modal.getInstance(prescriptionmodal);

function previewprescription(){
  var care_taken = $('#care_taken').val();
  var medicines = $('#medicines').val();
  var date = new Date();
  if(care_taken == '' || medicines == ''){
    M.toast({html: 'Please fill in all the fields first!'});
  }
  else{
    $('#care_taken_holder').html(care_taken.replace(/\n/g, '<br />'));
    $('#medicines_holder').html(medicines.replace(/\n/g, '<br />'));
    $('#date_holder').html(date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate());
    instance.open();
  }
}


$(document).ready(function(){
  $('#care_taken').characterCounter();
  $('#previewprescription').click(previewprescription);
  $('#submitbutton').click(function(){
    $('#prescription-form').submit();
  });
});
