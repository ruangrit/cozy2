/**
 * @file
 * International Phone Field
 *
 * Activates the intl-tel-input library for use with Drupal.
 */
(function ($) {
  Drupal.behaviors.international_phone = {
    attach: function (context, settings) {
      // Require jQuery 1.7 or above.
      var vernums = $.fn.jquery.split('.');
      if (parseInt(vernums[0]) >= 1 && parseInt(vernums[1]) >= 7) {
        var $fields = $(context).find('.international_phone-number');

        if ($fields.length) {

          // Initialize International Phone Field.
          $fields.intlTelInput({
            utilsScript: settings.internationalPhone.utilsScriptPath,
            //autoPlaceholder: true,
            nationalMode: false,
            //separateDialCode: true,
            initialCountry: "th",
            preferredCountries: [ "us", "gb", "th" ],
          });

          // Make the International Phone field cognizant of country code fields.
          $fields.each(function () {
            var $form = $(this).closest('form'),
                country_code = settings.internationalPhone.defaultCountryCode;
            $form.find('.country-list .country').change(function () {
              var code = $(this).data('dial-code');
              if (code) {
                country_code = code;
              }
            });
            // Update field before ajax submits to enforce country code.
            $form.on('ajaxStart submit', function () {
              var number = $(this).val();
              if (
                  typeof number !== 'undefined'
                  && number.replace(/^\D+/g, '').length
                  && number.indexOf('+') === -1
              ) {
                $(this).val('+' + country_code + ' ' + number);
              }
            });
          });

          


          // On key up or change remove the error class.
          $fields.on('keyup change', function () {
            $(this).removeClass('error');
            //console.log($(this).getNumber());
          });

          // On Blur, softly validate the number entered.
          // This validation is intentionally not enforced.
          $fields.blur(function () {
            $(this).removeClass('error');
            if (
                $(this).val().replace(/^\D+/g, '').length
                && $(this).intlTelInput('isValidNumber')
            ) {
              //====$(this).addClass('success');
            } else {
              //========$(this).removeClass('success').addClass('error');
            }
          });
        }
      }
    }
  };
}(jQuery));
