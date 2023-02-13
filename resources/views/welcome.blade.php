<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>
<body class="bg-blue-200"  >

    <div class="flex justify-center ">
        <div class="w-1/3  mt-10 ml-7 ">
            <img src="{{ asset('images/items.png') }}" alt="Image">
        </div>
        <div class=" w-2/6  p-15  ml-12 mt-20 rounded-lg" w-3>

                <form class="bg-orange-500 p-3 rounded-lg flex flex-col">
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="email">
                        CONNEXION A VOTRE COMPTE :
                    </label>
                    <input class="w-full border border-gray-400 p-2 rounded-lg" type="email" id="email" name="email" required >
                    </div>
                    <div class="mb-6 flex flex-col">
                    <label class="block text-gray-700 font-medium mb-2" for="password">
                        MOT DE PASSE :
                    </label>
                    <input class="w-full border border-gray-400 p-2 rounded-lg" type="password" id="password" name="password" required >
                    <p class=" self-end"><a href="{{ url('/inscris') }}">Mot de Passe Oublié ?</a></p>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-3 px-4 self-center rounded-lg ">
                    Connexion
                    </button>
                </form>

            </div>

    </div>

    
      
</body>
</html>