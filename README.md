Installation
===========================
Begin by installing this package through Composer. Edit your project's <code>composer.json</code> file to require <code>dinesh/bugonemail</code>.

<pre>
<code>
"require": {
    "laravel/framework": "4.1.*",
    "jay/paypal": "dev-master"
}
</code>
</pre>
Next, update Composer from the Terminal:
<pre>
<code>
composer update
</code>
</pre>

Once this operation completes, the next step is to add the service provider. Open <code>app/config/app.php</code>, and add a new item to the providers array.
<pre>
<code>
'Jay\Paypal\PaypalServiceProvider',
</code>
</pre>
Next, you need to publish it's config file(s).
<pre>
<code>
Run php artisan config:publish jay/paypal
</code>
</pre>
Next, you run <code> paypal:install</code> command on terminal.
<pre>
<code>
php artisan paypal:install
</code>
</pre>
