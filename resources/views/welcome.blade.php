<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weather</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Make json or xml files of weather for today.
                </div>

                <div class="choose_file">
                    <div class="choose_file-type">
                        <p>
                            Choose a type of file:
                        </p>
                    </div>
                    <select id="file_type">
                        <option selected value="json">JSON</option>
                        <option value="xml">Xml</option>
                    </select>
                    <button id="make_file" onclick="App.makeFile()">
                        Make
                    </button>
                    <div id="is_done" class="hidden">
                    </div>
                    <div id="is_error" class="hidden">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
