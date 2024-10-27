<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'slug' => Str::uuid(),
            'place' => $this->faker->address(),
            'published_at' => $this->faker->dateTime(),
            'content' => '<h1>La Brillante Carrera de Lionel Andrés Messi</h1>

<p><strong>Lionel Andrés Messi</strong> es considerado uno de los mejores futbolistas de todos los tiempos. Nacido en <em>Rosario, Argentina</em>, el 24 de junio de 1987, Messi ha deslumbrado al mundo del fútbol con su increíble habilidad, visión de juego y capacidad goleadora.</p>

<p>Con su histórico paso por el <a href="https://www.fcbarcelona.com/">FC Barcelona</a>, donde ganó múltiples títulos de <strong>La Liga</strong>, <strong>la Champions League</strong> y otros trofeos internacionales, Messi dejó una huella imborrable en el fútbol mundial. Durante su tiempo en Barcelona, Messi se convirtió en el máximo goleador de la historia del club, marcando más de 600 goles.</p>

<p>En el 2021, Lionel Messi decidió emprender una nueva etapa en su carrera, fichando por el <a href="https://www.psg.fr/">Paris Saint-Germain (PSG)</a>. Aunque su legado en Barcelona es insuperable, Messi sigue demostrando su calidad en cada partido.</p>

<h2>Los Logros de Messi</h2>

<ul>
    <li>7 veces ganador del <strong>Balón de Oro</strong>.</li>
    <li>Máximo goleador histórico del <strong>FC Barcelona</strong>.</li>
    <li>Campeón de la <em>Copa América</em> 2021 con la selección de Argentina.</li>
</ul>

<p>Además de sus éxitos con clubes, Messi logró el mayor reconocimiento con la <a href="https://www.afa.com.ar/">selección argentina</a> al llevar a su país al título en la Copa América 2021 y siendo una pieza clave en la clasificación de Argentina a la <em>Copa del Mundo</em>.</p>

<img src="https://www.fcbarcelona.com/photo-resources/2020/03/29/fb93f75f-ece8-408c-85c8-a3ee0f045291/27-05-09-MESSI-ALEGRIA-02.jpg?width=500" alt="Lionel Messi celebrando un gol" class="img-fluid mt-3"/>

<p>Messi no solo es admirado por su destreza técnica, sino también por su humildad fuera del campo. A lo largo de los años, ha inspirado a millones de aficionados y jóvenes jugadores alrededor del mundo, convirtiéndose en un ícono del fútbol moderno.</p>
',
        ];
    }
}
