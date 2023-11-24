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

  '/java'                             => 'CompilerService@java',
  '/python'                           => 'CompilerService@python',
  '/cpp'                              => 'CompilerService@cpp',
  '/csharp'                           => 'CompilerService@csharp',
  '/go'                               => 'CompilerService@go',
  '/typescript'                       => 'CompilerService@typescript',

  '/run/java/{id}'                    => 'CodeRunnerService@java',
  '/run/python/{id}'                  => 'CodeRunnerService@python',
  '/run/cpp/{id}'                     => 'CodeRunnerService@cpp',
  '/run/csharp/{id}'                  => 'CodeRunnerService@csharp',
  '/run/go/{id}'                      => 'CodeRunnerService@go',
  '/run/typescript/{id}'              => 'CodeRunnerService@typescript',

  '/submit/java/{id}'                 => 'SubmitService@java',
  '/submit/python/{id}'               => 'SubmitService@python',
  '/submit/cpp/{id}'                  => 'SubmitService@cpp',
  '/submit/csharp/{id}'               => 'SubmitService@csharp',
  '/submit/go/{id}'                   => 'SubmitService@go',
  '/submit/typescript/{id}'           => 'SubmitService@typescript',

  '/question/java/{id}'               => 'QuestionService@java',
  '/question/python/{id}'             => 'QuestionService@python',
  '/question/cpp/{id}'                => 'QuestionService@cpp',
  '/question/csharp/{id}'             => 'QuestionService@csharp',
  '/question/go/{id}'                 => 'QuestionService@go',
  '/question/typescript/{id}'         => 'QuestionService@typescript',

  '/questionlist/level/{id}'          => 'QuestionService@questionListByLevel',

  '/questionlist/all'                 => 'QuestionService@getAllQuestions',

  '/test/{id}/{id}/{id}'              => 'TestService@test',
  '/test/{id}/{id}'                   => 'TestService@test',
  '/test/{id}'                        => 'TestService@test',
];