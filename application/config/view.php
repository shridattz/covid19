<?php
$config['views'] = array (
    'header' => 'common/header',
    'footer' => 'common/footer',
    'login' => array (
        'title' => 'Covid 19 | Login',
        'style' => 'login/login.css',
        'script' => 'login/login.js',
        'body' => 'login/login',
        'footer' => 'common/no_footer'
    ),
    'register' => array (
        'title' => 'Covid 19 | Register',
        'style' => 'register/register.css',
        'script' => 'register/register.js',
        'body' => 'register/register'

    ),
    'dashboard' => array (
        'title' => 'Covid 19 | Dashboard',
        'style' => 'dashboard/dashboard.css',
        'script' => array( 
        'http://d3js.org/d3.v3.min.js','http://d3js.org/topojson.v1.min.js','https://rawgit.com/Anujarya300/bubble_maps/master/data/geography-data/datamaps.none.js'
        ),
        'body' => 'dashboard/dashboard'
    ),
    'forgotpassword' => array (
        'title' => 'Covid 19 | Forgot Password',
        'style' => 'login/forgotpassword.css',
        'script' => 'login/forgotpassword.js',
        'body' => 'login/forgotpassword'
    )
);