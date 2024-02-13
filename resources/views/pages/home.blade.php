@extends('app')

@push('header')
    <script type="text/javascript">
        const translations = {
            green: "{{ __('Проезд на зеленый!') }}",
            red: "{{ __('Проезд на красный. Штраф!') }}",
            early_yellow: "{{ __('Слишком рано начали движение!') }}",
            late_yellow: "{{ __('Успели на желтый!') }}"
        };
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush

@push('content')
    <div class="traffic-container">
        <div id="traffic-light">
            <div class="light green"></div>
            <div class="light yellow"></div>
            <div class="light red"></div>
        </div>
        <button id="go-button">Вперед</button>
        <div id="log-table"></div>
    </div>
@endpush
