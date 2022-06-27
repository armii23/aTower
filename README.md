## Temperature Sensors

Please find how to launch the application of the API bellow.

### Requirements

To use application you need:

- **Laravel 8.0**
- **Database: MySQL 5.7**
- **PHP: 7.3 or 7.4**

### Application launching

<pre>
<code>
cp .env.example file
php artisan key:generate
</code>
</pre>

NOTICE:
You can change the amount of fake data from the <code>database/seeders/DatabaseSeeder.php</code> file

Change the values <code>30</code> to something else:
```php
Sensor::factory(30)->create();
Temperature::factory(30)->create();
```

Then run the commands

<pre>
<code>
php artisan migrate --seed
php artisan serve
</code>
</pre>
