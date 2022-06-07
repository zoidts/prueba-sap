<!DOCTYPE html>
<html class="semi-dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')

<body>
    <div id="app">
        <app-component></app-component>
    </div>
    @include('layouts.scriptsjs')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
