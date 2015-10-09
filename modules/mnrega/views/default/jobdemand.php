<script>
 $(document).ready( function(){
  populateDropdown("<?=Yii::getAlias('@web').'/jsons/district.json'?>",'district');
  $('#district').change(function(event)
  {
   populateDropdown("<?=Yii::getAlias('@web').'/jsons/'?>"+$(this).val()+".json",'block');
   $('#panchayat').empty();
  });
  $('#block').change(function(event)
  {
   populateDropdown("<?=Yii::getAlias('@web').'/jsons/'?>"+$(this).val()+".json",'panchayat');
   
  });
   $('input').addClass('form-control');
  $('select').addClass('form-control');
   $('button').addClass('btn');
 });
 
</script>
<form id="request-form" class="form small" role="form">

   <div class="row">
   <div class="container-fluid">
   <label for="mobilenumber">Mobile Number</label>
     <input type="text" id="mobilenumber" size="10" placeholder="Mobile Number of demand" />
 <button id="search-btn" class="btn-small btn-primary">Search</button>

</div>
</div>
<div id="results"></div>
   <div class="row">
   <div class="container-fluid">
 <label for="name">Name</label>
 <input type="text" id="name" name="name" size="20">
  <label for="fname">Father's Name/Husband's Name</label>
 <input type="text" id="fname" name="fname" size="20">
  <label for="jobcardno">Job Card No</label>
 <input type="text" id="jobcardno" name="jobcardno" size="30">
 </div>
 </div>
 <div class="row">
<div class="col-md-4">
<label for="district">District</label>
   <select id="district" name="district">

   </select>
    </div>
<div class="col-md-4">
   <label for="blocks">Block</label>

   <select id="block" name="block">
   </select>
   </div>
   <div class="col-md-4">
   <label for="panchayat">Panchayat</label>

   <select id="panchayat" name="panchayat">
   </select>
   </div>
   </div>
   <div class="row">
   <div class="container-fluid">
  <label for="village">Village Name</label>
 <input type="text" id="village" size="20" name="village">
 </div>
   </div>
   <div class="row">
   <div class="col-md-4">
    <label for="days">No of days</label>
   <input type="text" id="days" name="days" size="3" placeholder="Number of days" />
  
   </div>
   <div class="col-md-4">
    <label for="datefrom">Date From</label>
   <input type="text" id="datefrom" name="datefrom" size="10" placeholder="date in dd/mm/yyyy format" />
   </div>
   <div class="col-md-4">
  <label for="dateto">Date To</label>
  <input type="text" id="dateto" size="10" name="dateto" placeholder="date in dd/mm/yyyy format" />
</div>
</div>

   <button id="submit-btn" class="btn-small btn-primary">Submit Demand</button>

 </form>