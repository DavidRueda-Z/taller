<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cronómetro</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        .tiempo {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        button {
            padding: 12px 18px;
            border: none;
            border-radius: 6px;
            background: #3498db;
            color: white;
            cursor: pointer;
            font-weight: bold;
            margin: 5px;
        }

        button:hover {
            background: #2980b9;
        }

        .btn-reset {
            background: #e74c3c;
        }

        .btn-reset:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

    @include('partials.volver')

    <div class="container">

        <h1>Cronómetro</h1>

        <div class="tiempo" id="display">00:00:00.000</div>

        <button onclick="iniciar()">Iniciar</button>
        <button onclick="pausar()">Pausa</button>
        <button class="btn-reset" onclick="reiniciar()">Reiniciar</button>

    </div>


<script>
    let inicio = 0;
    let intervalo;
    let corriendo = false;

    function actualizarDisplay() {
        const ahora = Date.now();
        const tiempo = ahora - inicio;

        const ms = tiempo % 1000;
        const totalSeg = Math.floor(tiempo / 1000);

        const seg = totalSeg % 60;
        const min = Math.floor(totalSeg / 60) % 60;
        const horas = Math.floor(totalSeg / 3600);

        document.getElementById("display").textContent =
            `${String(horas).padStart(2, "0")}:` +
            `${String(min).padStart(2, "0")}:` +
            `${String(seg).padStart(2, "0")}.` +
            `${String(ms).padStart(3, "0")}`;
    }

    function iniciar() {
        if (!corriendo) {
            inicio = Date.now() - (inicio ? (Date.now() - inicio) : 0);
            intervalo = setInterval(actualizarDisplay, 10);
            corriendo = true;
        }
    }

    function pausar() {
        if (corriendo) {
            clearInterval(intervalo);
            corriendo = false;
        }
    }

    function reiniciar() {
        clearInterval(intervalo);
        corriendo = false;
        inicio = 0;
        document.getElementById("display").textContent = "00:00:00.000";
    }
</script>

</body>
</html>
