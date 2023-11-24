<?php

$routes = [
  '/user/create'                      => 'UserService@index',
  '/user/login'                       => 'UserService@login',
  '/user/update'                      => 'UserService@update',
  '/user'                             => 'UserService@list',
  '/user/forgotpass'                  => 'UserService@changepassword',
  '/user/getotp'                      => 'UserService@getotp',
  '/user/dashboard'                   => 'UserService@dashboard',

  '/'                                 => 'HomeService@index',

 

  '/test/{id}/{id}/{id}'              => 'TestService@test',
  '/test/{id}/{id}'                   => 'TestService@test',
  '/test/{id}'                        => 'TestService@test',
];