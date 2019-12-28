<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>LineBot develop</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.1.4/tailwind.min.css">
        <style>
            body {
                font-family: 'system-ui';
            }
        </style>
    </head>

    <body class="bg-blue-100 p-4">

        <form action="/test" method="POST" class="max-w-lg bg-white shadow-md rounded-lg p-4 ml-auto mr-auto">
            @csrf

            <h1 class="text-2xl mb-2">請輸入文字</h1>
            <input type="text" name="text" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none" value="My name is Lucas" required>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
        </form>

        @dump($text, $matches, $parameters, $parameterNames)

    </body>
</html>
