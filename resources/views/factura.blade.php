<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe de la cita</title>
</head>

<body>
    <div style="display: flex; justify-content: space-between;">
        <img src="{{ public_path('img/logo-2.png') }}" alt="">
        <div id="1" style="flex: 1;">
            <p>
                Clínica dental guadalquivir
            </p>
            <p>NIF: 765545123F</p>
            <p>Calle amarguillo nº 14</p>
            <p>956887744 / 602589977</p>
        </div>
        <div style="background-color: beige;">
            <h2 style="text-align: center">Datos del cliente</h2>
            <div>
                <div style="float: left; width: 20%; height: 80%;">
                    <h4 style="margin: 0;">Nombre y apellido: </h4>
                    <h4 style="margin: 0;">DNI/NIF: </h4>
                    <h4 style="margin: 0;">Dirección: </h4>
                    <h4 style="margin: 0;">Telefono: </h4>
                    <h4 style="margin: 0;">Email: </h4>

                </div>
                <div style="width: 75%; height: 20%;">
                    <p style="margin: 0;">{{ $transa->user->first_name }} {{ $transa->user->last_name }}</p>
                    <p style="margin: 0;">{{ $transa->user->dni }}</p>
                    <p style="margin: 0;">{{ $transa->user->address }}</p>
                    <p style="margin: 0;">{{ $transa->user->phone }}</p>
                    <p style="margin: 0;">{{ $transa->user->email }}</p>
                </div>
            </div>
        </div>
        <br>
        <br>

        <div>
            <table style="border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">Descripción</th>
                    <th style="border: 1px solid black; padding: 8px;">Servicio</th>
                    <th style="border: 1px solid black; padding: 8px;">Unidades</th>
                    <th style="border: 1px solid black; padding: 8px;">Precio</th>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 8px;">Servicio de suscripción</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $transa->plan->name }}</td>
                    <td style="border: 1px solid black; padding: 8px;">1</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ number_format(($transa->plan->price / 1.21), 2) }}€</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="border: 1px solid black; padding: 8px;">IVA (21%)</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ number_format($transa->plan->price - ($transa->plan->price / 1.21), 2) }}€</td>                    
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="border: 1px solid black; padding: 8px;">Descuento</td>
                    <td style="border: 1px solid black; padding: 8px;">{{$transa->plan->price - $transa->amount}}€</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="border: 1px solid black; padding: 8px;">Total (con IVA)</td>
                    <td style="border: 1px solid black; padding: 8px;">{{$transa->amount}}€</td>
                </tr>
            </table>
            
        </div>
</body>


</html>
