/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var map;
var markers;
function populateDropdown(url,id,clickableid)
{
     clickableid= typeof clickableid !== 'undefined' ? clickableid : null;
      $.ajax({
         'url':url,
          'type':'GET',
          'beforeSend':function() {
             $('#'+id).html('<img src="'+imageloader+'" />');
          },
          'success':
          function(data)
          {
          if (typeof data !='object')
              data = $.parseJSON(data)
               $('#'+id).html('');
                var htmlToAppend='<option>None</option>';
                //$('#'+id).append(htmlToAppend);
              $.each(data,function(key,value)
         {
       //  alert(key+'-'+value);
        htmlToAppend +="<option value='"+key+"'>" + value  + "</option>";
       // $('#'+id).append("<option value='"+key+"'>" + value  + "</option>");
       //$('#'+id).append( new Option(value,key) );
         });

                 
                 $('#'+id).append(htmlToAppend); 
                  if (clickableid !=null)
             $('#'+clickableid).trigger('click');
}
});
}
function populateHtml(url,id,clickableid)
{
    clickableid= typeof clickableid !== 'undefined' ? clickableid : null;
     $.ajax({
          'url':url,
          'type':'GET',
          
          'beforeSend':function() {
             $('#'+id).html('<img src="'+imageloader+'" />');
          },
          'success':
          function(data)
          {
          
             $('#'+id).html(data); 
             if (clickableid !=null)
             $('#'+clickableid).trigger('click');
          }});
}
function addMarker(gpslat,gpslong)
{
marker =new L.marker([gpslat,gpslong]);
	  map.addLayer(marker);
      map.panTo(new L.latLng(gpslat,gpslong)); 

}

function hindiEnable(elem)
{
   if ($('#hindiinput-type').val()==='kruti')
 {
  elem.addClass('kruti');
  elem.removeClass('hindiinput');
  //console.log(google_control);
   if (typeof google_control =='object' && google_control.isTransliterationEnabled())
    google_control.toggleTransliteration();
  // console.log(google_control);
  elem.focus(function()
 {
   $(this).val(Convert_to_Kritidev_010($(this).val()));
   
 });
 elem.focusout(function()
 {
// alert($(this).val());
   $(this).val(convert_to_unicode($(this).val()));
  // alert($(this).val());
   
 });
 $('.input-type').remove();
 $('.kruti').after('<span class="input-type">Kruti Dev Text</span>');
 } else
 if ($('#hindiinput-type').val()=='google')
 {
  elem.addClass('hindiinput');
  
   elem.removeClass('kruti');
   $('.hindiinput').off('focus');
    $('.hindiinput').off('focusout');
   if (typeof google_control =='object' && !google_control.isTransliterationEnabled())
    google_control.toggleTransliteration();
   $('.hindiinput').focus(function(){hindiEnable($(this))});
    $('.input-type').remove();

   $('.hindiinput').after('<span class="input-type">Google Transliteration</span>');
 }
 if (typeof google_control =='object')
       
       google_control.makeTransliteratable(elem);
}
    function hindi1Enable(elem){
  //   if (elem==null)
      elem =$('.hindiinput');
      /*
             var options = {
          sourceLanguage:
              google.elements.transliteration.LanguageCode.ENGLISH,
          destinationLanguage:
              [google.elements.transliteration.LanguageCode.HINDI],
          shortcutKey: 'ctrl+g',
          transliterationEnabled: true
      };
            google_control =
          new google.elements.transliteration.TransliterationControl(options);
     */
     if (typeof google_control =='object')
       
       google_control.makeTransliteratable(elem);
    }
function exportToPdf(selector,url)
{
  $.post(url,
  {'html':$(selector)[0].outerHTML},
  function(data){
  document.write( data);
  }
  );

}
/*
function updateClock ( )
 	{
 	var currentTime = new Date ( );
  	var currentHours = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );

  	// Pad the minutes and seconds with leading zeros, if required
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  	// Choose either "AM" or "PM" as appropriate
  	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  	// Convert the hours component to 12-hour format if needed
  	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  	// Convert an hours component of "0" to "12"
  	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  	// Compose the string for display
  	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  	
  	
   	$("#clock").html(

$.datepicker.formatDate('dd/mm/yy', new Date())+'<br/>'+

currentTimeString);
   	  	
 }

$(document).ready(function()
{
   setInterval('updateClock()', 1000);
});
*/
