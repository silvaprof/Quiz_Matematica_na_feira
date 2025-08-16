
<?php
$arquivo = 'respostas.csv';

if (!file_exists($arquivo)) {
    die('Nenhuma resposta registrada ainda.');
}

$dados = array_map('str_getcsv', file($arquivo));
$cabecalho = array_shift($dados);

// Descobre o índice da coluna "Pontuação" no cabeçalho
$idx_pontuacao = array_search('Pontuação', $cabecalho);
// Ordena pelo índice da pontuação, do maior para o menor
usort($dados, function($a, $b) use ($idx_pontuacao) {
    return intval($b[$idx_pontuacao]) - intval($a[$idx_pontuacao]);
});
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ranking do Quiz</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; }
        h2 { text-align: center; margin-top: 32px; }
        table { border-collapse: collapse; width: 90%; max-width: 600px; margin: 24px auto; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; font-size: 1.08em; }
        th { background-color: #e0f7fa; color: #219150; }
        tr:nth-child(even) { background: #f9f9f9; }
        a { display: block; text-align: center; margin: 18px auto; color: #27ae60; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h2>Ranking do Quiz</h2>
    <table>
        <thead>
            <tr>
                <?php foreach ($cabecalho as $col) echo "<th>" . htmlspecialchars($col) . "</th>"; ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Gabarito das questões (ajuste conforme necessário)
            $gabarito = ['B','C','A','C','B','A']; // Exemplo para 6 questões, todas corretas "B"
            foreach ($dados as $linha) {
                echo "<tr>";
                foreach ($linha as $i => $col) {
                    // Destacar alternativas erradas
                    if ($i > 0 && $i <= count($gabarito) && isset($gabarito[$i-1])) {
                        if ($col !== $gabarito[$i-1]) {
                            echo "<td style='color:red;font-weight:bold'>" . htmlspecialchars($col) . "</td>";
                        } else {
                            echo "<td>" . htmlspecialchars($col) . "</td>";
                        }
                    } else {
                        echo "<td>" . htmlspecialchars($col) . "</td>";
                    }
                }
                echo "</tr>";
            } ?>
        </tbody>
    </table>
    <a href="index.html">Voltar ao Quiz</a>
</body>
</html>
