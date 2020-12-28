<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">

      h2{
        text-align: center;
        padding-bottom: 10px;
        margin-bottom: 10px;
      }
      table{
        width: 100%;
        table-layout: fixed;
      }
      .col{
        margin: 1em 0;
      }
      .col p:first-of-type{
        margin-bottom: 0px;
      }
      .small-text{
        font-size: 0.9em;
      }
      hr{
        display: block;
        height: 1px;
        background: transparent;
        width: 100%;
        border: none;
        border-top: solid 1px #aaa;
      }
    </style>
  </head>
  <body>
    <div id="prescriptionmodal">
      <h2>Logo Name</h2>
      <hr>
      <div class="">
        <table border="0">
          <tr>
            <td>
              <div class="col">
                <p><b>Doctor: {{ $consultation->doctor()->first()->name }}</b></p>
              </div>
            </td>
            <td style="text-align: right;">
              <div class="col">
                <p><b>For Patient: {{ $consultation->patient()->first()->name }}</b></p>
              </div>
            </td>
          </tr>
        </table>
        <div class="col">
          <p><b>Illness: </b>{{ $consultation->illness_title }}</p>
        </div>
        <div class="col">
          <p><b>Care to be taken: </b></p>
          <p class="small-text">
            {!! nl2br($prescription->care_taken) !!}
          </p>
        </div>
        <div class="col">
          <p><b>Medicines to be used: </b></p>
          <p class="small-text">
            {!! nl2br($prescription->medicines) !!}
          </p>
        </div>
        <div class="col">
          @php
          $prescriptiondate = $prescription->updated_at;
          $prescriptiondate = date_create($prescriptiondate);
          $prescriptiondate = date_format($prescriptiondate, "jS F Y");
          @endphp
          <p><small class="small-text">Date: {{ $prescriptiondate }}</small></p>
        </div>
      </div>
    </div>
  </body>
</html>
