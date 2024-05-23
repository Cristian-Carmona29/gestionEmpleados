<?php

use Tests\TestCase;
use App\Models\empleados;

class EmpleadosTest extends TestCase
{
    public function test_creacion_empleado(): void
    {
        $empleado = empleados::create([
            'Nombre' => 'John',
            'Apellido' => 'Doe',
            'Correo' => 'john@example.com',
            'Telefono' => '123456789',
            'Foto' => 'default.jpg',
            'departamento_id' => 1,
        ]);

        $this->assertInstanceOf(empleados::class, $empleado);
        $this->assertEquals('John', $empleado->Nombre);
    }
}
