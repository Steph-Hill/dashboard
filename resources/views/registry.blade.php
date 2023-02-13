<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>
<body>
    <div class="min-w-screen min-h-screen bg-gray-900 flex items-center justify-center px-20 py-10">
        <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
            <div class="md:flex w-full ">
                <div class="hidden md:block w-1/2  bg-orange-600 pt-40 px-5">
                    <img src="{{ asset('images/items.png') }}" alt="Image">
                </div>
                <div class="w-full md:w-1/2 py-10 px-5 md:px-5 bg-orange-600  " >
                    <div class="text-center mb-2">
                        <h1 class="font-bold text-3xl text-gray-900">INSCRIPTION</h1>
                       
                    </div>
                    <div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-2">
                                <label for="" class="text-xs font-semibold text-gray-900 px-1">NOM :</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                                    <input type="text" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="John">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-2">
                                <label for="" class="text-xs font-semibold text-gray-900 px-1">EMAIL :</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                    <input type="email" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="johnsmith@example.com">
                                </div>
                            </div>
                        </div> 
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-2">
                                <label for="" class="text-xs font-semibold text-gray-900 px-1">ENTREPRISE : </label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                                    <input type="text" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="John">
                                </div>
                            </div>
                            
                        </div>
                                             
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-2">
                                <label for="" class="text-xs font-semibold text-gray-900 px-1">MOT DE PASSE : </label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                    <input type="password" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="************">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-2">
                                <label for="" class="text-xs font-semibold text-gray-900 px-1">CONFIRMATION DE MOT DE PASSE : </label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                    <input type="password" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="************">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <button class="block w-full max-w-xs mx-auto  bg-blue-600 hover:bg-blue-800 focus:bg-blue-800 text-white rounded-lg px-3 py-3 font-semibold">REGISTER NOW</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
</body>
</html>