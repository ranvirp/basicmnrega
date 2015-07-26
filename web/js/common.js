/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var map;
var markers;
function populateDropdown(url,id)
{
      $.get(url,
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
}
);
}
function populateHtml(url,id)
{
     $.get(url,
          function(data)
          {
             $('#'+id).html(data); 
          });
}
function addMarker(gpslat,gpslong)
{
marker =new L.marker([gpslat,gpslong]);
	  map.addLayer(marker);
      map.panTo(new L.latLng(gpslat,gpslong)); 

}


    function hindiEnable(elem){
     if (elem==null)
      elem =$('.hindiinput');
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
        google_control.makeTransliteratable(elem);
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
