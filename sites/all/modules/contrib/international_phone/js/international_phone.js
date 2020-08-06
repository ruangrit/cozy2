(function ($) {

  Drupal.behaviors.international_phone = {
    attach: function (context, settings) {
      $(".international_phone-number").intlTelInput({
        //utilsScript: "lib/libphonenumber/build/utils.js"
        autoFormat: true,
        defaultCountry: 'th',
        autoHideDialCode: true,
		

      });
    }
  };

}(jQuery));
