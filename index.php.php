<?php
$msg = "";

// Caminho do banco SQLite
$dbFile = __DIR__ . "/mensagens.db"; 

try {
    // Conexão com SQLite
    $pdo = new PDO("sqlite:" . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco: " . $e->getMessage());
}

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
        try {
            // Salvar no SQLite
            $stmt = $pdo->prepare("
                INSERT INTO mensagens (data_envio, nome, email, mensagem)
                VALUES (:data_envio, :nome, :email, :mensagem)
            ");
            $stmt->execute([
                ":data_envio" => date("Y-m-d H:i:s"),
                ":nome"       => $nome,
                ":email"      => $email,
                ":mensagem"   => $mensagem
            ]);

            // Salvar no CSV
            $linha = [
                date("Y-m-d H:i:s"),
                $nome,
                $email,
                str_replace(["\r", "\n"], [" ", " "], $mensagem)
            ];
            $arquivo = __DIR__ . "/mensagem.csv";
            $fp = fopen($arquivo, "a");
            if ($fp) {
                fputcsv($fp, $linha, ";");
                fclose($fp);
            } else {
                throw new Exception("Erro ao salvar no CSV.");
            }

            $msg = "Mensagem enviada e salva no banco e no CSV com sucesso!";
        } catch (Exception $e) {
            $msg = "Erro ao salvar: " . $e->getMessage();
        }
    }
}

if ($msg) {
    echo "<p><strong>$msg</strong></p>";
}

require "index.view2.php";
