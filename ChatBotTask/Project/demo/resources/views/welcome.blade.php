<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
<x-bootstrap-Css></x-bootstrap-Css>
    </head>
  <body>
    <x-navbar></x-navbar>
<h1 style="text-align: center;color:red"> Laravel course</h1>
<x-bootstrap-js></x-bootstrap-js>
  </body>
</html>
