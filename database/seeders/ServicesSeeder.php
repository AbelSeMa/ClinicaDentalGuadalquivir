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
                'service' => 'Revisión Anual',
                'description' => 'La revisión anual se ofrece como método de control para garantizar que la salud de nuestra boca. Con la revisión detectamos posibles problemas, y lo que es más importante, nos permite actuar antes de que sea demasiado tarde'
            ],
            [
                'service' => 'Revisión semestral',
                'description' => 'La revisión semestral se ofrece como método eficaz de control para garantizar que la salud de nuestra boca. Con la revisión detectamos posibles problemas, y lo que es más importante, nos permite actuar antes de que sea demasiado tarde'
            ],
            [
                'service' => 'Revisión trimestral',
                'description' => 'La revisión trimestral se ofrece como método óptimo de control para garantizar que la salud de nuestra boca. Con la revisión detectamos posibles problemas, y lo que es más importante, nos permite actuar antes de que sea demasiado tarde'
            ],
            [
                'service' => 'Radiografías',
                'description' => 'Se pone a disposición de los pacientes el servicio de radiografías en el momento de la consulta, sin esperas ni costes adicionales',
            ],
            [
                'service' => 'Descuentos en tratamientos básicos',
                'description' => 'Los clientes que disfruten del plan básico tendrán un 10% de descuento en los tratamientos tales como, limpieza bucodental, tratamiento de blanqueamientos, caries, etc..'
            ],
            [
                'service' => 'Descuentos en tratamientos intermedios',
                'description' => 'Los clientes que disfruten del plan básico tendrán un 10% de descuento en los tratamientos tales como, tratamiento periodontal, sustitución de piezas dentales, carillas, etc..'
            ],
            [
                'service' => 'Descuentos en tratamientos avanzados',
                'description' => 'Los clientes que disfruten del plan básico tendrán un 10% de descuento en los tratamientos tales como, implantes, ortodoncias, y otros tratamientos de carácter avanzado'
            ],
            [
                'service' => 'Limpieza dental anual',
                'description' => 'La limpieza dental realizada periódicamente en la consulta del odontólogo es, más que un hábito saludable, una necesidad a la hora de mantener la salud dental en un estado óptimo. Aun cuando se practica una buena higiene bucal es casi inevitable la acumulación de placa bacteriana y sarro en la línea de la encía o el cuello de los dientes.'
            ],
            [
                'service' => 'Limpieza dental semestral',
                'description' => 'La limpieza dental realizada periódicamente en la consulta del odontólogo es, más que un hábito saludable, una necesidad a la hora de mantener la salud dental en un estado óptimo. Aun cuando se practica una buena higiene bucal es casi inevitable la acumulación de placa bacteriana y sarro en la línea de la encía o el cuello de los dientes. Con el servicio semestral podrá disfrutar de dos limpiezas dentales al año, tal y como recomiendan los dentistas.'
            ],
            [
                'service' => 'Limpieza dental avanzada',
                'description' => 'La limpieza dental realizada periódicamente en la consulta del odontólogo es, más que un hábito saludable, una necesidad a la hora de mantener la salud dental en un estado óptimo. Aun cuando se practica una buena higiene bucal es casi inevitable la acumulación de placa bacteriana y sarro en la línea de la encía o el cuello de los dientes. Disfruta de una limpieza avanzada con la última tecnología y post-tratamiento, que hará que tu boca esté saludable por más tiempo.'
            ],
            [
                'service' => 'Asesoramiento de higiene dental',
                'description' => 'Asesoramiento personalizado por parte de nuestros expertos para que tu boca se mantenga siempre saludable y evitar los problemas derivados de una mala higiene.'
            ],
            [
                'service' => 'Asesoramiento de imagen',
                'description' => 'Asesoramiento personalizado por parte de nuestros expertos para que consigas esa sonrisa que siempre has buscado. Con nuestro sistema de sonrisas 3D, podrás ver cómo quedaría esa sonrisa perfecta.'
            ],
            [
                'service' => 'Asesoramiento avanzado de estilo de vida y salud dental',
                'description' => 'Asesoramiento personalizado por parte de nuestros expertos para que te deshagas de esos malos hábitos que provocan problemas de salud en nuestra boca. También podrás disfrutar de una serie de clases para saber aplicar las mejores técnicas para que tu sonrisa siempre se vea radiante.'
            ],
            [
                'service' => 'Tratamiento de blanqueamiento básico',
                'description' => 'Ofrecemos un tratamiento de blanqueamiento dental que podrás realizar en tu propia casa, sin necesidad de desplazarte a nuestra clínica.'
            ],
            [
                'service' => 'Tratamiento de blanqueamiento avanzado',
                'description' => 'Ofrecemos un tratamiento de blanqueamiento dental avanzado que se realiza en varias sesiones en nuestra clínica por expertos. El tratamiento consiste en aplicar una luz LED durante 45 minutos, proporcionando un blanco en unas cuantas sesiones.'
            ],
            [
                'service' => 'Recordatorio de citas',
                'description' => 'Nuestro equipo de citas te informará con un par de días de antelación de la cita para que no faltes. En caso de no poder asistir deberás avisar con antelación para programarle otra cita lo antes posible.'
            ],
            [
                'service' => 'Materiales para la higiene dental',
                'description' => 'Desde la clínica dental Guadalquivir ponemos a disposición de nuestros clientes tanto los materiales que necesiten para su tratamiento como los instrumentos requeridos por los doctores.'
            ]                        
            // Agrega más servicios según sea necesario
        ];

        foreach ($servicios as $servicio) {
            DB::table('services')->insert($servicio);
        }
    }
}
