Using Laravel 5.5:-

1. Create VirtualHost
I have added ServerName assignment.localhost
#<VirtualHost *:80>
#    ServerAdmin webmaster@dummy-host2.example.com
#    DocumentRoot "D:/wamp/www/assignment/public"
#    ServerName assignment.localhost
#    #SetEnv SITE_ENVIRONMENT LOCAL
#    CustomLog "logs/dummy-host2.example.com-access.log" common
#    <Directory "D:/wamp/www/assignment/public">
#        Allow from all
#        AllowOverride All
#    </Directory>
#</VirtualHost>


2. Run composer
    composer install

3. Run npm
    npm install

4. Routes
    I have resource Route. We can manage route according to action.
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/assignments', 'AssignmentsController');

5. Run below commend for build asstes with larvel-mix, like (JS, Css)
    npm run dev (this command generated app.css and app.js)
    after this
    npm run watch (this command immediately impact or added your current css & js changes in app.css and app.js)

6. Created vue component.
   Path: resources\assets\js\components\Assignment.vue

7. Using Intervention\Image lib for image upload.
    http://image.intervention.io/getting_started/installation
    We can using Stroge for file upload but after upload image from Stroge image is corrupted or not opne properly.
    so I have using this library.

8. Using vue-bootstrap-datetimepicker component for datepicker
    Date of Birth: Datepicker Using in this field.


9.  Validation
    Phone number start 00
    Phone number 10 degit after 09 (009829270316)
    Date of Birth: valid if your age 18 or more than 18

