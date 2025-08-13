
<?php

    $msg = "";


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = trim($_POST["nome"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $mensagem = trim($_POST["mensagem"] ?? "");

        // Validação
        if (empty($nome) || empty($email) || empty($mensagem)) {
            $msg = "Por favor, preencha todos os campos.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "E-mail inválido.";
        } else {

            // Formatar para CSV
            $linha = [
                date("Y-m-d H:i:s"),
                $nome,
                $email,
                str_replace(["\r", "\n"], [" ", " "], $mensagem)
            ];
            $arquivo = __DIR__ . "/mensagem.csv";

            // Function para armazenar a mensagem
            $fp = fopen($arquivo, "a");
            if ($fp) {
                fputcsv($fp, $linha, ";");
                fclose($fp);
                $msg = "Mensagem enviada com sucesso!";
            } else {
                $msg = "Erro ao salvar o Mensagem.";
            }
        }
    }
    if ($msg) {
        echo "<p><strong>$msg</strong></p>";
    }

require "index.view2.php";
