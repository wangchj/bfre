# Introduction

This web application is built using Yii Framework 2. The framework utilizes the model-view-controller (MVC) architecture. What this means is that when a user sends a request to this application, it is first sent to a controller. The controller is the conductor and contains the logic on how to process this request. The controller may read the database, construct models based on the data from the database, and render the proper view to return to the user.

The source code for this application has the following structure.

```
bfre/
    config/        config files, e.g. database info
    controllers/   controller classes
    models/        model classes correspond to database tables
    modules/       contains admin module
    runtime/       temporary application data, such as logs
    views/         view files used by controllers
    web/           contains application entry point
```

# Requirements

- PHP 5.5 or above.
- [Composer](https://getcomposer.org/)
- [MySQL](http://www.mysql.com)
- [Yii Framework 2](http://www.yiiframework.com/)
- [Git](http://git-scm.com/)

# Installation

## Composer Installation

Composer is a PHP dependency manager and is required by this application. Composer is a self contained application. All that is needed to install Composer is to download and move it to a directory that on the binary search path.

On Linux and Mac OS X, Composer can be downloaded using the following command.

```
curl -s http://getcomposer.org/installer | php
```

After downloading, you may optionally move it to a binary directory included in the path environment variable, so that composer may be easily accessed. For example, assuming `~/bin` is on the path, we can move Composer to this directory by running:

```
mv composer.phar ~/bin/composer
```

## Application Installation

The source repository of this application resides at https://github.com/wangchj/bfre. 

The following installs the application from the repository.

```
cd ~
git clone https://github.com/wangchj/bfre.git
cd bfre
composer.phar install
mkdir runtime
mkdir web/assets
mkdir web/photos
chmod 777 runtime web/assets web/photos
mv web ~/public_html
mv web/.htaccess.gator web/.htaccess
```

Note, for security, the root of the application should be stored in a web inaccessible location, such as `~`. The `web` directory should be copied to a web accessible location such `public_html` because the directory contains application entry point.

## Post-installation Configuration

### Database Configuration

The configuration file for database is config/db.php. The format of the file follows:

```
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=bfr',
    'username' => 'bfr',
    'password' => 'bfr',
    'charset' => 'utf8',
];
```

On HostGator, it is ok to leave the host=localhost. dbname should be changed to the name of the mysql database that is configured for this application.

Username and password should be changed to the mysql user login and password.

### Mail Configuration

To be determined

# Modifying the Application

This section covers the structure and basic concept of this application. The information in this section is intended for someone who wants to peek inside the code and modify the behavior of the application.

As mentioned in the introduction, being built on top of Yii 2, this application is model-view-controller (MVC) architecture. We'll look at each of the components in this section.

## Models

Model classes represent the data of this application and are stored under `models/` directory. The data we use in this application are obtained from the database; therefore, models have one-to-one correspondence with the database tables.

The following are a list of tables in our system, and corresponding model classes.

Table          | Model Class   | Remark
-----          | -----------   | ------
Properties     | Property      |
PropertyTypes  | PropertyType  |
Users          | User          |
TempUsers      | TempUser      | Temp table for new users

The purpose of model classes is for the ease of data loading and manipulation. Model classes also have data validation rules derived from database integrity constraints to make the application more secure.

## Controllers

Controller classes are the 'brain' of the application and determine what request can be made to the application. Controllers are stored in `controllers/`. Each controller class is further divided into actions. If you open up one of the controller classes in a text editor, you'd see a few functions with a name prefixed with 'action', for example `SiteController->actionLogin()`. These are controller function.

When an user makes a request, it is routed to the proper controller and action. For example, when the user visits http://bfre/site/login, the function `actionLogin()` of `SiteController` is executed. If no controller is specified, the default controller is `SiteController`.

An action will usually load models, perform data processing, and renders a view.

## Views

Views are the visible part of the website. View files are stored in `views/` directory. These files contains HTML, CSS, as well as some code to render application models. If you want to change the general layout or just a word on a page, view files are where you want to look.

Controller actions will call `$this->render('view_file')` to render a view file. To find the view file that is render for a request, look for this call.

This application uses [Bootstrap](http://getbootstrap.com/) for CSS layout and other UI components. Please refer to the website for documentations.