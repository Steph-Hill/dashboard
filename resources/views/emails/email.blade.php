<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Confirmation d'inscription</h1>
    <h2>Bienvenue</h2>
    <ul>
        <li>Nom : <strong>

            {{-- verification si producteur_name existe dans le tableau demandé --}}
            @if (isset($user['producteur_name']))

            {{-- producteur_name existe, on affiche dans la balise strong --}}

              {{ $user['producteur_name'] }}

              {{-- verification si commercant_name existe dans le tableau demandé --}}
            @elseif (isset($user['commercant_name']))

            {{-- commercant_name existe, on affiche dans la balise strong --}}

              {{ $user['commercant_name'] }}

              {{-- si aucun n'est trouvé faire écrire Nom non défini --}}
            @else
              Nom non défini
            @endif

          </strong></li>
        <li>Email :<strong>{{$user['email']}}</strong></li>
    </ul>
    
</body>
</html>