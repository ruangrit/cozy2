# International Phone Field

## Description

A Drupal module that provides a field type (via Field API) for storing international phone numbers. The module also provides a corresponding field widget that allows user's to choose the phone number country code by selecting the associated country flag.

## Dependenices

* [jquery_update](https://www.drupal.org/project/jquery_update)
* [libraries](https://www.drupal.org/project/libraries) *(7.x-2.x)*
* [intl-tel-input](https://github.com/jackocnr/intl-tel-input) *(JavaScript library)*

##Installation

1. Download and unzip this module into your modules directory.
2. Download and unzip the `intl-tel-input` JavaScript library ([https://github.com/jackocnr/intl-tel-input/releases](https://github.com/jackocnr/intl-tel-input/releases)) to `sites/all/libraries/intl-tel-input` so that the js file is located here: `sites/all/libraries/intl-tel-input/build/js/intlTelInput.js`
2. Go to **Administration > Modules** and enable this module (*International Phone Field*).

Roadmap
----------
* Add phone number validation (per country)

Original Author
---------------

* [Mayur Jadhav](https://www.drupal.org/u/mayurjadhav) ([Contact](https://www.drupal.org/user/2266604/contact))

*If you use this module, find it useful, or want to send the author
a thank you note, please feel free to send feedback using the contact link above.*

*The original author is also available for paid customizations
of this and other modules, and may also be reached via the above contact link above*
