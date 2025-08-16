
<?php
$arquivo = 'respostas.csv';

// Recebe os dados do formulário
$nome = $_POST['nome'] ?? '';
$q1 = $_POST['q1'] ?? '';
$q2 = $_POST['q2'] ?? '';
$q3 = $_POST['q3'] ?? '';
$q4 = $_POST['q4'] ?? '';
$q5 = $_POST['q5'] ?? '';
$q6 = $_POST['q6'] ?? '';



// Validação das respostas
$mensagem = "";
$respostas = [];
$pontuacao = 0;

// Questão 1
if ($q1 === "B") {
    $respostas[] = "Questão 1: Resposta correta! Maria pagará R$18,75 pela compra.";
    $pontuacao++;
} else if ($q1) {
    $respostas[] = "Questão 1: Resposta incorreta. O valor correto é R$18,75.";
} else {
    $respostas[] = "Questão 1: Nenhuma alternativa selecionada.";
}

// Questão 2
if ($q2 === "C") {
    $respostas[] = "Questão 2: Resposta correta! João pagará R$ 13,75 pela compra.";
    $pontuacao++;
} else if ($q2) {
    $respostas[] = "Questão 2: Resposta incorreta. A resposta correta é R$ 13,75.";
} else {
    $respostas[] = "Questão 2: Nenhuma alternativa selecionada.";
}



// Questão 3
if ($q3 === "A") {
    $respostas[] = "Questão 3: Resposta correta! Ísis pagará R$ 6,00 pela compra.";
    $pontuacao++;
} else if ($q3) {
    $respostas[] = "Questão 3: Resposta incorreta. A resposta correta é R$ 6,00.";
} else {
    $respostas[] = "Questão 3: Nenhuma alternativa selecionada.";
}


// Questão 4
if ($q4 === "C") {
    $respostas[] = "Questão 4: Resposta correta! Maya pagará R$ 22,50 pela compra.";
    $pontuacao++;
} else if ($q4) {
    $respostas[] = "Questão 4: Resposta incorreta. A resposta correta é R$ 22,50.";
} else {
    $respostas[] = "Questão 4: Nenhuma alternativa selecionada.";
}


// Questão 5
if ($q5 === "B") {
    $respostas[] = "Questão 5: Resposta correta! Lucca pagará R$ 14,00 pela compra.";
    $pontuacao++;
} else if ($q5) {
    $respostas[] = "Questão 5: Resposta incorreta. A resposta correta é R$ 14,00.";
} else {
    $respostas[] = "Questão 5: Nenhuma alternativa selecionada.";
}


// Questão 6
if ($q6 === "A") {
    $respostas[] = "Questão 6: Resposta correta! Lara pagará R$ 13,80 pela compra.";
    $pontuacao++;
} else if ($q6) {
    $respostas[] = "Questão 6: Resposta incorreta. A resposta correta é R$ 13,80.";
} else {
    $respostas[] = "Questão 6: Nenhuma alternativa selecionada.";
}


// Cria o Csv se não existir
if (!file_exists($arquivo)) {
    $fp = fopen($arquivo, 'w');
    fputcsv($fp, ['Nome', 'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Pontuação', 'Data']);
    fclose($fp);
}


// Salva no CSV
if ($nome) {
    $data = date('d/m/Y H:i:s');
    $linha = [$nome, $q1, $q2, $q3, $q4, $q5, $q6, $pontuacao, $data];
    $novo = !file_exists($arquivo);
    $fp = fopen($arquivo, 'a');
    if ($novo) {
        fputcsv($fp, ['Nome', 'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Pontuação', 'Data']);
    }
    fputcsv($fp, $linha);
    fclose($fp);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado do Quiz</title>
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', Arial, sans-serif; }
        .container { max-width: 420px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 32px 24px; }
        h2 { text-align: center; color: #27ae60; margin-bottom: 24px; }
        ul { margin: 18px 0 18px 0; padding: 0 0 0 18px; }
        li { margin-bottom: 8px; font-size: 1.08em; color: #34495e; }
        .score { font-size: 1.15em; color: #219150; text-align: center; margin: 18px 0; font-weight: bold; }
        .links { text-align: center; margin-top: 24px; }
        .links a { color: #27ae60; text-decoration: none; font-weight: bold; margin: 0 12px; }
        .links a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Resultado do Quiz</h2>
        <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
        <ul>
        <?php foreach ($respostas as $resp) {
            echo '<li>' . $resp . '</li>';
        } ?>
        </ul>
        <div class="score"><strong>Pontuação:</strong> <?php echo $pontuacao; ?> de 6</div>
        <div class="links">
            <a href="index.html">Voltar ao Quiz</a> |
            <a href="ranking.php">Ver Ranking</a>
        </div>
    </div>
</body>
</html>

