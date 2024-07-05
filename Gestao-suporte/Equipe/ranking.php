<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f8f9fa;
            overflow-y: auto;
        }

        h1 {
            text-align: center;
            color: #343a40;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;

        }

        .container h1 {}

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .agente {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #343a40;
            border: 1px solid #dee2e6;
            border-radius: 15px;
            padding: 20px;
            margin: 10px;
            width: 100%;
            max-width: 300px;
            text-align: center;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        .agente:hover {
            background-color: black;
            color: #343a40;
            cursor: pointer;
            transition: 1s ease;
            color: white
        }

        input,
        select {
            width: 100%;
            margin: 5px 0;
        }

        .geral {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #343a40;
            border: 2px solid #ffc107;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fff;
        }

        .result {
            color: #343a40;
            margin-top: 20px;
            display: flex;
            flex-direction: row;
            width: 100%;
            border: 1px solid black;
            border-radius: 15px;
        }

        .btn_editar {
            width: 150px;
            height: 50px;
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
            text-align: center;
        }

        .inpt_result::placeholder {
            text-align: center;
            color: #343a40;
        }

        input.inpt_result {
            all: unset;
            font-size: 2em;
            padding: 5px;
            color: #343a40;
            border: 1px solid black;
            border-radius: 10px;
            text-align: center;
        }

        .flex-wrap {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .hidden {
            display: none;
        }

        .result_title {
            color: #343a40;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <header class="container">
        <h1>Ranking Equipe</h1>
    </header>

    <main class="container">
        <div id="result" class="result">

        </div>
        <div class="card">
            <select name="month" id="month" onchange="fetchGeralData()">
                <option value="">Selecione o Mês</option>
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Março</option>
                <option value="4">Abril</option>
                <option value="5">Maio</option>
                <option value="6">Junho</option>
                <option value="7">Julho</option>
                <option value="8">Agosto</option>
                <option value="9">Setembro</option>
                <option value="10">Outubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>
            <div class="geral">
                <h2>Geral</h2>
                <div>
                    <label for="inpt_geral">Quantidade de Atendimentos</label>
                    <input id="inpt_geral" name="quant_atend" type="number" placeholder="Insira a Quantidade">
                    <button id="btn_slv" onclick="salv_geral()">Salvar Geral</button>
                </div>
            </div>
            <div class="flex-wrap">
                <?php
                include ("conexao.php");

                $query = "SELECT * FROM equipe";
                $pendentes = mysqli_query($mysqli, $query);

                if (!$pendentes) {
                    echo "Erro ao executar a consulta: " . mysqli_error($mysqli);
                    exit;
                }

                while ($row = mysqli_fetch_assoc($pendentes)) {
                    $id = htmlspecialchars($row['id']);
                    echo "<div id='agente_$id' class='agente'>";
                    echo "<h2>" . htmlspecialchars($row['nome']) . "</h2>";
                    echo "<label class='agent_quant' for='quant_atend_$id'>Quantidade de Atendimentos<input id='quant_atend_$id' name='quant_atend' type='number' placeholder='Insira a Quantidade'></label>";
                    echo "<label class='agent_nota' for='nota_$id'>Nota Média<input id='nota_$id' name='quant_atend' type='number' placeholder='Insira a Nota'></label>";
                    echo "<label class='agent_percent' for='percent_$id'>Percentual de Avaliação<input id='percent_$id' name='quant_atend' type='number' placeholder='Insira a Nota'></label>";
                    echo "<button onclick='somar_agent($id)' class='agente_btn'>Salvar</button>";
                    echo "</div>";
                }
                mysqli_close($mysqli);
                ?>
            </div>
        </div>
    </main>

    <script>
        var ranking1 = 0
        var ranking2 = 0
        var ranking3 = 0
        const at_geral = document.querySelector('#inpt_geral');
        const monthSelect = document.querySelector('#month');
        const resultDiv = document.querySelector('#result');
        const btn_slv = document.querySelector('#btn_slv');
        const geral = document.querySelector('.geral');


        let quantidade = 0;

        function disableAllAgentButtons() {
            const agenteBtns = document.querySelectorAll('.agente_btn');
            agenteBtns.forEach(btn => btn.disabled = true);
        }

        function enableAllAgentButtons() {
            const agenteBtns = document.querySelectorAll('.agente_btn');
            agenteBtns.forEach(btn => btn.disabled = false);
        }

        function fetchAgentData() {
    const selectedMonth = monthSelect.value;
    if (selectedMonth) {
        $.ajax({
            url: 'fetch_agents.php',
            type: 'POST',
            data: { month: selectedMonth },
            success: function (response) {
                const agents = JSON.parse(response);
                agents.forEach(agent => {
                    document.querySelector(`#quant_atend_${agent.id_colaborador}`).value = agent.quant_atend || '';
                    document.querySelector(`#nota_${agent.id_colaborador}`).value = agent.nota_med || '';
                    document.querySelector(`#percent_${agent.id_colaborador}`).value = agent.percent_av || '';

                    // Atualizar o ranking e estilo de acordo
                    const div = document.querySelector(`#agente_${agent.id_colaborador}`);
                    div.querySelector('h3')?.remove(); // Remover h3 existente, se houver
                    const rank = agent.rank;
                    div.innerHTML += `<h3>Rank ${rank}</h3>`;
                    switch (rank) {
                        case '1':
                            div.style.backgroundColor = '#d4edda';
                            break;
                        case '2':
                            div.style.backgroundColor = '#fff3cd';
                            div.style.color = '#343a40';
                            break;
                        case '3':
                            div.style.backgroundColor = '#f8d7da';
                            break;
                    }
                });
            },
            error: function () {
                alert('Erro ao buscar dados dos agentes.');
            }
        });
    } else {
        resultDiv.innerHTML = '';
    }
}


// Modifique a função fetchGeralData para chamar fetchAgentData
function fetchGeralData() {
    const selectedMonth = monthSelect.value;
    if (selectedMonth) {
        $.ajax({
            url: 'fetch_geral.php',
            type: 'POST',
            data: { month: selectedMonth },
            success: function (response) {
                const data = JSON.parse(response);
                if (data.quantidade !== null) {
                    resultDiv.innerHTML = `<h1 class='result_title'>Quantidade já inserida para o Mês: </h1>
                    <input class='inpt_result' type='number' disabled placeholder='${data.quantidade}' />`;
                    resultDiv.innerHTML += `<button onclick='edt_total()' class='btn_editar'>Editar</button>`;
                    geral.innerHTML += `<div class="totalcaixinha"></div>`;
                    const caixinha = document.querySelector('.totalcaixinha');
                    caixinha.innerHTML += `<input class='caixinha' type='number' placeholder='Qual o Total da Caixinha' />`;

                    enableAllAgentButtons();
                    quantidade = data.quantidade;
                    btn_slv.disabled = true;
                } else {
                    resultDiv.innerHTML = '';
                    disableAllAgentButtons();
                    btn_slv.disabled = false;
                }
                // Chamar a nova função para buscar dados dos agentes
                fetchAgentData();
            },
            error: function () {
                alert('Erro ao buscar dados.');
                btn_slv.disabled = false;
            }
        });
    } else {
        resultDiv.innerHTML = '';
    }
}



        function salv_geral() {
            const quant_atend = at_geral.value;
            const selectedMonth = monthSelect.value;

            if (!selectedMonth) {
                alert('Selecione um mês.');
                return;
            }

            $.ajax({
                url: 'enviar_geral.php',
                type: 'POST',
                data: { quant_atend: quant_atend, mes: selectedMonth },
                success: function (response) {
                    alert('Salvo com sucesso!');
                    fetchGeralData();
                }
            });
        }

        function somar_agent(id) {
    const caixinha = document.querySelector('.caixinha');

    const divId = `agente_${id}`;
    const div = document.getElementById(divId);
    div.querySelector('h3')?.remove(); // Remover h3 existente, se houver

    const quantAtendInput = document.querySelector(`#quant_atend_${id}`).value;
    const notaInput = document.querySelector(`#nota_${id}`).value;
    const percentInput = document.querySelector(`#percent_${id}`).value;
    const percentual_atend = ((quantAtendInput / quantidade) * 100).toFixed(2);
    const percentual_nota = ((notaInput / 5) * 100).toFixed(2);

    const percentualAtendNum = parseFloat(percentual_atend);
    const percentualNotaNum = parseFloat(percentual_nota);
    const percentNum = parseFloat(percentInput);
    var percent_caix = 0;
    const media_des = ((percentualAtendNum + percentualNotaNum + percentNum) / 3).toFixed(2);

    var rank = 0;
    const selectedMonth = monthSelect.value;

    if (media_des <= 48) {
        percent_caix = caixinha.value * 0.23;
        div.innerHTML += `<h3>Rank 3</h3>`;
        rank = 3;
        alert('o acumulado da caixinha do ranking é 23%: ');
        ranking3 = percent_caix;
        div.style.backgroundColor = '#f8d7da';
    } else if (media_des > 48 && media_des <= 50.99) {
        div.style.backgroundColor = '#fff3cd';
        div.style.color = '#343a40';
        div.innerHTML += `<h3>Rank 2</h3>`;
        rank = 2;
        percent_caix = caixinha.value * 0.33;
        alert('o acumulado da caixinha do ranking é 33%: ');
        ranking2 = percent_caix;
    } else if (media_des >= 51) {
        div.innerHTML += `<h3>Rank 1</h3>`;
        rank = 1;
        percent_caix = (caixinha.value * 0.43).toFixed(2);
        ranking1 = percent_caix;
        div.style.backgroundColor = '#d4edda';
    }

    $.ajax({
        url: 'enviar_agente.php',
        type: 'POST',
        data: {
            quant_atend: quantAtendInput,
            nota: notaInput,
            percent: percentInput,
            id: id,
            percent_des: media_des,
            rank: rank,
            mes: selectedMonth
        },
        success: function (response) {
            alert('Salvo com sucesso!');
            fetchGeralData();
        },
        error: function () {
            alert('Erro ao salvar dados.');
            btn_slv.disabled = false;
        }
    });
}

        function edt_total() {
            const inpt_result = document.querySelector('.inpt_result');
            const btn_editar = document.querySelector('.btn_editar');

            if (inpt_result.disabled) {
                btn_editar.textContent = 'Salvar';
                inpt_result.disabled = false;
            } else {
                inpt_result.disabled = true;
                btn_editar.textContent = 'Editar';
                var new_quant = inpt_result.value;
                $.ajax({
                    url: 'editar_geral.php',
                    type: 'POST',
                    data: {
                        quantidade: new_quant
                        , mes: monthSelect.value
                    },
                    success: function (response) { },
                    error: function () {
                        alert('Erro ao buscar dados.');
                        btn_slv.disabled = false;
                    }
                });
            }
        }
    </script>
</body>

</html>