public function run()
{
\DB::table('coches')->insert([
[
'marca' => 'Toyota',
'modelo' => 'Corolla GR',
'precio' => 35000,
'anyo' => 2024,
'imagen' =>
'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Toyota_GR_Corolla_1.jpg/800px-Toyota_GR_Corolla_1.jpg',
'descripcion' => 'Un compacto deportivo increíble para la ciudad y el circuito.'
],
[
'marca' => 'Ford',
'modelo' => 'Mustang GT',
'precio' => 55000,
'anyo' => 2023,
'imagen' =>
'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/2018_Ford_Mustang_GT_5.0.jpg/800px-2018_Ford_Mustang_GT_5.0.jpg',
'descripcion' => 'La potencia americana clásica con motor V8.'
]
]);
}