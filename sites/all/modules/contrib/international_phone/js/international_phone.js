// Old js

(function ($) {

  Drupal.behaviors.international_phone = {
    attach: function (context, settings) {
      $(".international_phone-number").intlTelInput({
        //utilsScript: "lib/libphonenumber/build/utils.js"
      });
    }
  };

}(jQuery));


/**
 * @file
 * International Phone Field
 *
 * Activates the intl-tel-input library for use with Drupal.
 */
 /*
(function ($) {
  Drupal.behaviors.international_phone = {
    attach: function (context, settings) {
      // Require jQuery 1.7 or above.
      var vernums = $.fn.jquery.split('.');
      console.log(parseInt(vernums[0]));
      console.log(parseInt(vernums[1]));
      if (parseInt(vernums[0]) >= 1 && parseInt(vernums[1]) >= 7) {
        var $fields = $(context).find('.international_phone-number');

        if ($fields.length) {

          // Initialize International Phone Field.
          
          $fields.intlTelInput({
            //utilsScript: settings.internationalPhone.utilsScriptPath,
            autoPlaceholder: true
          });
          return false;
          // Make the International Phone field cognizant of country code fields.
          $fields.each(function () {
            console.log('xxxxxx');
            var $form = $(this).closest('form'),
            country_code = settings.internationalPhone.defaultCountryCode;
            $form.find('.country-list .country').click(function () {
              var code = $(this).data('dial-code');
              console.log(code);
              if (code) {
                country_code = code;
              }
            });
            // Update field before ajax submits to enforce country code.

            $form.on('ajaxStart submit', function () {
              //==var number = $(this).val();
              var number = $(this).find('.international_phone-number').val();
              console.log('number = ' + number);
              if (
                  typeof number !== 'undefined'
                  && number.replace(/^\D+/g, '').length
                  && number.indexOf('+') === -1
              ) {
                console.log('country_code=' +country_code);
                //==$(this).val('+' + country_code + ' ' + number);
                $(this).find('.international_phone-number').val('+' + country_code + ' ' + number);
              }
            });
            
          });

          // On key up or change remove the error class.
          $fields.on('keyup change', function () {
            console.log('key up field' + $(this).val());
            $(this).removeClass('error');
          });

          // On Blur, softly validate the number entered.
          // This validation is intentionally not enforced.
          $fields.blur(function () {
            $(this).removeClass('error');
            if (
                $(this).val().replace(/^\D+/g, '').length
                && $(this).intlTelInput('isValidNumber')
            ) {
              $(this).addClass('success');
            } else {
              $(this).removeClass('success').addClass('error');
            }
          });
        }
      }
    }
  };
}(jQuery));
*/
