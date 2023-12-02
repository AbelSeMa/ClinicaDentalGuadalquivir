<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicios = [
            [
                'Name' => 'Revisión Anual',
                'Description' => 'La revisión anual se ofrece como método de control para garantizar que la salud de nuesta boca.
                                  Con la revisión detectamos posibles problemas, y lo que es más importante, 
                                  nos permite actuar antes de que sea demasaido tarde',
            ],
            [
                'Name' => 'Revisión semestral',
                'Description' => 'La revisión semestral se ofrece como método eficaz de control para garantizar que la salud de nuesta boca.
                                  Con la revisión detectamos posibles problemas, y lo que es más importante, 
                                  nos permite actuar antes de que sea demasaido tarde',
            ],
            [
                'Name' => 'Revisión trimestral',
                'Description' => 'La revisión trimestral se ofrece como método óptimo de control para garantizar que la salud de nuesta boca.
                                  Con la revisión detectamos posibles problemas, y lo que es más importante, 
                                  nos permite actuar antes de que sea demasaido tarde',
            ],
            [
                'Name' => 'Radiografías',
                'Description' => 'Se pone a disposición de los pacientes el servicio de radiografías en el momento de la consulta,
                                  sin esperas ni costes adicionales',
            ],
            [
                'Name' => 'Descuentos en tratamientos básicos',
                'Description' => 'Los clientes que disfruten del plan básico tendrán un 10% de descuento en los tratamientos tales como,
                                  limpieza bucodental, tratamiento de blanqueamientos, caries, etc..',
            ],
            [
                'Name' => 'Descuentos en tratamientos intermedios',
                'Description' => 'Los clientes que disfruten del plan básico tendrán un 10% de descuento en los tratamientos tales como,
                                  tratamiento periodontal, sustitución de piezas dentales, carillas, etc..',
            ],
            [
                'Name' => 'Descuentos en tratamientos avanzados',
                'Description' => 'Los clientes que disfruten del plan básico tendrán un 10% de descuento en los tratamientos tales como,
                                  implantes, ortodoncias, y otros tratamiento de caracter avanzado',
            ],
            [
                'Name' => 'Limpieza dental anual',
                'Description' => 'La limpieza dental realizada periódicamente en la consulta del odontólogo es, más que un hábito saludable, 
                                  una necesidad a la hora de mantener la salud dental en un estado óptimo. Aun cuando se practica una buena higiene bucal 
                                  es casi inevitable la acumulación de placa bacteriana y sarro en la línea de la encía o el cuello de los dientes.',
            ],
            [
                'Name' => 'Limpieza dental semestral',
                'Description' => 'La limpieza dental realizada periódicamente en la consulta del odontólogo es, más que un hábito saludable, 
                                  una necesidad a la hora de mantener la salud dental en un estado óptimo. Aun cuando se practica una buena higiene bucal 
                                  es casi inevitable la acumulación de placa bacteriana y sarro en la línea de la encía o el cuello de los dientes.
                                  Con el servicio semestral podrá disfrutar de dos limpiezas dentales al año, tal y como recomienda los dentistas.',
            ],
            [
                'Name' => 'Limpieza dental avanzada',
                'Description' => 'La limpieza dental realizada periódicamente en la consulta del odontólogo es, más que un hábito saludable, 
                                  una necesidad a la hora de mantener la salud dental en un estado óptimo. Aun cuando se practica una buena higiene bucal 
                                  es casi inevitable la acumulación de placa bacteriana y sarro en la línea de la encía o el cuello de los dientes.
                                  Difruta de una limpieza avanzada con la última tecnología y post-tratamiento, que hará que tu boca esté saludable
                                  por más tiempo.',
            ],            
            [
                'Name' => 'Asesoramiento de higiene dental',
                'Description' => 'Asesoramiento personalizado por parte de nuestros expertos para que tu boca se mantenga siempre saludable
                                  y evitar los problemas derivados de una mala higiene.',
            ],
            [
                'Name' => 'Asesoramiento de imagen',
                'Description' => 'Asesoramiento personalizado por parte de nuestros expertos para que consigas esa sonrisa que siempre has 
                                  buscado. Con nuestro sistema de sonrisas 3D, podrás ver como quadaría esa sonrisa perfecta.',
            ],
            [
                'Name' => 'Asesoramiento avanzado de estilo de vida y salud dental',
                'Description' => 'Asesoramiento personalizado por parte de nuestros expertos para que te deshagas de esos malos hábitos que
                                  provocan problemas de salud en nuestra boca. También podrás disfrutar de una serie de clases para saber 
                                  aplicar las mejores técnicas para tú sonrisa siempre se vea radiante.',
            ],
            [
                'Name' => 'Tratamiento de blanqueamiento básico',
                'Description' => 'Ofrecemos un tratamiento de blanqueamiento dental que podrás realizar en su propia casa, sin necesidad
                                  de desplazamiento a nuestra clínica.',
            ],
            [
                'Name' => 'Tratamiento de blanqueamiento avanzado',
                'Description' => 'Ofrecemos un tratamiento de blanqueamiento dental avanzado que se realiza en varias sesiones en nuestra clínica
                                  por expertos. El tratamiento consiste en aplicar una luz LED durante 45 minutos, proporcionando un blanco en unas
                                  cuantas sesiones.',
            ],
            [
                'Name' => 'Recordatorio de citas',
                'Description' => 'Nuestro equipo de citas, te informará con un par de días de antelación de la cita para que no faltes.
                                  En caso de no poder asistir deberá avisar con antelación para programarle otra cita lo antes posible.',
            ],            
            [
                'Name' => 'Materiales para la higiene dental',
                'Description' => 'Desde clínica dental Guadalquivir ponemos a disposición de nuestros clientes, tanto los materiales que necesite
                                  para su tratamiento, como los instrumentos requeridos por los doctores.',
            ]
            // Agrega más servicios según sea necesario
        ];

        foreach ($servicios as $servicio) {
            DB::table('services')->insert($servicio);
        }
    }
}
