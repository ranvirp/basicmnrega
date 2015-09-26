      // Load the Google Transliterate API
      if (typeof google =='object')
      {
      google.load("elements", "1", {
            packages: "transliteration"
          });
          }
      function onLoad() {
        var options = {
            sourceLanguage:
                google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage:
                [google.elements.transliteration.LanguageCode.HINDI],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };

        // Create an instance on TransliterationControl with the required
        // options.
         google_control =
            new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textbox with id
        // 'transliterateTextarea'.
       // google_control.makeTransliteratable($('.hindiinput'));
       google_control.addEventListener(
  google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE,
            serverUnreachableHandler);

function serverUnreachableHandler(e) {
  document.getElementById("errorDiv").innerHTML =
  "Transliteration Server unreachable";
} 
      }
      if (typeof google=='object')
      {
      google.setOnLoadCallback(onLoad);
      }
      
   

