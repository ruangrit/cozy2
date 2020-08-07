; Drupal version
core = 7.x
api = 2

; Community dependencies for International Phone

; Libraries is needed to depend on external libraries
projects[libraries][version] = 2.3
projects[libraries][subdir] = contrib

; jQuery 1.7+ is required
projects[jquery_update][version] = 2.7
projects[jquery_update][subdir] = contrib

; The Intl-Tel-Input official library
libraries[intl-tel-input][download][type] = file
libraries[intl-tel-input][download][url] = https://github.com/jackocnr/intl-tel-input/archive/v9.2.0.tar.gz
