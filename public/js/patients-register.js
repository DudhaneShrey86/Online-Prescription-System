var illnesscounter = 1;

function addillness(){
  illnesscounter += 1;
  var str = `<div class="input-field col s12 illnessfield">
    <textarea name="illnesses[]" id="illness`+illnesscounter+`" class="materialize-textarea validate"></textarea>
    <label for="illness`+illnesscounter+`">Enter Illness Details</label>
  </div>
  <div class="input-field col s12 surgeryfield">
    <textarea name="surgeries[]" id="surgery`+illnesscounter+`" class="materialize-textarea validate"></textarea>
    <label for="surgery`+illnesscounter+`">Enter Surgery Details for the illness</label>
  </div>
  `;
  $('#illnessesdiv').append(str);
  $('#removeillness').removeAttr('disabled');
  if(illnesscounter >= 5){
    $('#addillness').attr('disabled', 'disabled');
  }
}

function removeillness(){
  illnesscounter -= 1;
  $('#illnessesdiv .illnessfield:last').remove();
  $('#illnessesdiv .surgeryfield:last').remove();
  if(illnesscounter <= 1){
    $('#removeillness').attr('disabled', 'disabled');
  }
  $('#addillness').removeAttr('disabled', 'disabled');
}


$(document).ready(function(){
  $('#addillness').click(addillness);
  $('#removeillness').click(removeillness);
});
