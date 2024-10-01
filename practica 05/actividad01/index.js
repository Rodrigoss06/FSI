function operar(operacion) {
    let numero1 = parseFloat(document.getElementById('numero1').value);
    let numero2 = parseFloat(document.getElementById('numero2').value);
    let solucion = document.getElementById('respuesta');
    let resultado = 0;

    // Validar que ambos números sean ingresados
    if (isNaN(numero1) || isNaN(numero2)) {
        solucion.innerHTML = "Por favor ingresa ambos números.";
        return;
    }

    // Realizar la operación dependiendo del botón presionado
    if (operacion === '+') {
        resultado = numero1 + numero2;
    } else if (operacion === '-') {
        resultado = numero1 - numero2;
    } else if (operacion === '*') {
        resultado = numero1 * numero2;
    } else if (operacion === '/') {
        if (numero2 === 0) {
            solucion.innerHTML = 'Error: División por 0';
            return;
        }
        resultado = numero1 / numero2;
    }

    // Mostrar el resultado en el div 'respuesta'
    solucion.innerHTML = `Resultado: ${resultado}`;
}
