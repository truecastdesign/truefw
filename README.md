True Framework File Structure - New Project

![True Framework](https://raw.githubusercontent.com/truecastdesign/true/master/assets/TrueFramework.png "True Framework")

v1.1.15

This file structure is used by the True Framwork located at [GitHub Repo True]: https://github.com/truecastdesign/true


Requires PHP 5.5 or newer.  

Install
-------

To install a new project with composer:

```sh
$ composer create-project truecastdesign/truefw project-name
```

Usage
-----

Build your website in the app folder using the available folder structure. 

The app folder should be located beside the public folder. Assets, such as images, css, js, pdfs, etc., should be located in the assets folder inside the public folder.

## Models

The business logic should live in the app/models directory.

The name space for them should be App.

Access with \App\ClassName();

## Views

Views live in the app/views directory. 

The top level of it will automatically be accessed using the default route. A use like this http://www.domain.com will access the file index.phtml. Urls like http://www.domain.com/about will access the file app/views/about.phtml.
To make a sub page of /about, create a directory inside views and name it the same as the file but without the .phtml part. 

```code
http://www.domain.com/about 		-> 	about.phtml
http://www.domain.com/about/staff 	-> 	about/staff.phtml
```

The page view files have meta data located at the top of the phtml file.

```php
title="Title of the page for the title tag"
description="The meta description content."
{endmeta}
```

#### example docs: http://platesphp.com/v3/simple-example/

The {endmeta} string is the delimiting end of the meta data and the start of the html and PHP. The meta data uses config ini file formatting rules.

The title key maps to $_metaTitle in the layout.

The description key maps to $_metaDescription.

The css key files get combined with other css files and minified and outputted in the $_css variable.
It should look like this: css="/assets/css/file.css, /assets/css/file2.css" 


The js key is for including JavaScript files in the page. They will be combined and minified and outputted in the $_js variable. It has a similar format to the css files.



The _layouts directory is where the base.phtml file lives and it has the header and footer in one file. The view content gets inserted into the middle of it after being processed with PHP.

The _partials directory is for storing parts of pages that can be used on multiple pages. You can include them using the {partial:filename.phtml} string.


## Controllers

Controllers for the page are not required but if you need more functionality they are where you can access models and pass them to the view. Use the $vars array with a unique key and value to pass variables to the view. Example: $vars['info'] = 'Info details.'; 

The controller filename should match the views filename but with a .php extension rather than a .phtml extension.

Create the same folder structure as the view for sub and sub sub page. You can store controllers for APIs or other site features in there as well. You probably want to put them in a folder that starts with an underscore and include it directly in the routes.php files.

## Routes

The app/routes.php file is for storing all your site routes in. The App class has get, post, put, patch, delete, options, and any methods available. Those will match the incoming request method. The 'any' method will match all of them.

```php
$App->get('/api/person/:value', function($request) use ($App) {
	$vars = []; 
	# if the code is short you can put it in here and if too long include a controller here and put your code in the controller file.

	$App->view->render('_api/person.phtml', $vars);
});
```

Be sure to order your routes from most specific to most general. Once a route matches a request, all routes below will not be checked or run. The main route for page handling should always be the last one as it matches all requests.

## Init

The init.php file if for all your bootstrap code. It runs on each request so try to keep it minimal. 

This line:

```php
$App->view = new \True\PhpView();
```

is for using the PHP view method. If you want to use something like Twig as your template system, you can change it here and use what ever you like.

## global functions

### p(array|object)

Quickly print out an array or object

### pr(array|object)

Preformatted print out an array or object

### pMethods(class object)

Print out a list of methods in the class. Good for exploring an API.

### currency(string|int)

Return number formatted for US currency

### esc(string|int|float, type)

Easily escape the output of all kinds of data with a shorter syntax than the builtin PHP function.
Types you can pass: string (default), email, encoded, float, int, url.


Issues
------

When running on localhost, cookies for logging into admin area will not set using Chrome. They require a domain. Use Firefox or Safari to develop site. 


