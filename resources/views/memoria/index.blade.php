<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de Memoria</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 100px);
            grid-gap: 15px;
            margin-top: 20px;
        }

        .card {
            width: 100px;
            height: 100px;
            background: #3498db;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            cursor: pointer;
            font-size: 2rem;
            color: white;
            transition: background 0.3s;
        }

        .card.flipped {
            background: #2ecc71;
        }

        .card.matched {
            background: #9b59b6;
            cursor: default;
        }

        .btn-reiniciar {
            background: #e67e22;
            color: white;
            padding: 10px 15px;
            margin-top: 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-reiniciar:hover {
            background: #cf6d1a;
        }
    </style>
</head>
<body>

    @include('partials.volver')

    <h1>Juego de Memoria</h1>

    <div id="game" class="grid"></div>

    <button class="btn-reiniciar" onclick="iniciarJuego()">Reiniciar Juego</button>

<script>
    let icons = ["🍎","🍌","🍇","🍓","🍒","🍍","🥝","🍉"];
    let cards = [];
    let flipped = [];
    let matched = 0;

    function iniciarJuego() {
        matched = 0;
        cards = [...icons, ...icons];
        cards.sort(() => Math.random() - 0.5);

        let grid = document.getElementById("game");
        grid.innerHTML = "";

        cards.forEach((icon, index) => {
            let card = document.createElement("div");
            card.className = "card";
            card.dataset.icon = icon;
            card.dataset.index = index;

            card.addEventListener("click", () => voltear(card));
            grid.appendChild(card);
        });
    }

    function voltear(card) {
        if (card.classList.contains("flipped") || card.classList.contains("matched")) return;
        if (flipped.length === 2) return;

        card.classList.add("flipped");
        card.textContent = card.dataset.icon;
        flipped.push(card);

        if (flipped.length === 2) {
            setTimeout(() => comparar(), 700);
        }
    }

    function comparar() {
        let [c1, c2] = flipped;

        if (c1.dataset.icon === c2.dataset.icon) {
            c1.classList.add("matched");
            c2.classList.add("matched");
            matched += 2;

            if (matched === cards.length) {
                alert("🎉 ¡Ganaste el juego!");
            }
        } else {
            c1.classList.remove("flipped");
            c1.textContent = "";
            c2.classList.remove("flipped");
            c2.textContent = "";
        }

        flipped = [];
    }

    // iniciar al cargar
    iniciarJuego();
</script>

</body>
</html>
