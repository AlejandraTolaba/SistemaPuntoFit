<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(sisPuntoFit\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(sisPuntoFit\Alumno::class, function (Faker\Generator $faker) {
    return [
        'nombre' => 'categoría '.$faker->unique()->randomDigit(),
        'descripcion' => $faker->text(45),
        'condicion'=>'1',
        'nombre'=>$faker->text(45),
        'apellido'=>$faker->text(45),
        'fecha_nacimiento'=>'1994-09-03',
        'dni'=>$faker->text(8),
        'sexo'=>'F',
        'domicilio'=>$faker->text(20),
        'telefono_celular'=>'154678765',
        'numero_contacto'=>'4254396',
        'email'=>$faker->safeEmail,
        'certificado'=>'SI',
        'fecha_certificado'=>'2019-04-03',
        'observaciones'=>'No hay observaciones',
        'estado'=>'Activo',
    ];  
});
