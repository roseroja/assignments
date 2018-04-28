Using Laravel 5.5 and setup :-

1.  I have created VirtualHost and run this project *assignment.localhost*

2.  Using "Intervention\Image" lib for image upload. Process below 3 points then configures Intervention\Image lib.
    http://image.intervention.io/getting_started/installation
    
    We can use Storage for file upload but after upload image from Storage image is corrupted or not open properly.
    so I have used this library.

3.  Run composer first because I have not upload vendor folder I have not uploaded composer install
    Before run composer comment below two lines in config/app.php file. Maybe can create a problem.

        Intervention\Image\ImageServiceProvider::class
        Image' => Intervention\Image\Facades\Image::class

    After successfully run composer the uncomment above the two lines.

4.  Run npm install After then Run below command for build assets with laravel-mix, like (JS, Css)
    then npm run dev (this command generated app.css and app.js)
    and npm run watch (this command immediately impact or added your current css & js changes in app.css and app.js)

5.  DB Setup: Change the database name or have same name as env file and run migration.

6.  Routes: I have use resource Route. We can manage route according to action.
        
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('/assignments', 'AssignmentsController');

7. Created vue component.
        
        resources\assets\js\components\Assignment.vue

8.  Using vue-bootstrap-datetimepicker component for datepicker
    Date of Birth: Datepicker Using in this field.

9.  Validation
    Phone number start 00
    Phone number 10 degit after 09 (009829270316)
    Date of Birth: valid if your age 18 or more than 18
