<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require_once 'util.php';

if ($_SERVER['REQUEST_METHOD'] != "POST")
    die ("Nao foi possivel enviar o email: Dados enviados do formulario de forma incorreta!");

// Obtem os dados do form
$host = $_POST['host'];
$port = $_POST['porta'];
$userName = $_POST['usuario'];
$password = $_POST['senha'];
$emailFrom = $_POST['de'];
$emailTo = $_POST['para'];
$emailCc = $_POST['cc'];
$emailCco = $_POST['cco'];
$subject = $_POST['assunto'];
$text = $_POST['texto'];

// Valida os dados obrigatorios que vieram do form
$caption = "Erro";
if (empty($host))
    messageBox($caption, "Nao foi possivel enviar o email: Servidor SMTP nao informado!");
if (empty($port))
    messageBox($caption, "Nao foi possivel enviar o email: Porta do servidor de envio de email nao informada!");
if (empty($userName))
    messageBox($caption, "Nao foi possivel enviar o email: Usuario para autenticacao com servidor de email nao informado!");
if (empty($password))
    messageBox($caption, "Nao foi possivel enviar o email: Senha para autenticacao com servidor de email nao informada!");
if (empty($emailFrom))
    messageBox($caption, "Nao foi possivel enviar o email: Email do usuario de envio nao informado!");
if (empty($emailTo))
    messageBox($caption, "Nao foi possivel enviar o email: Email do destinatario nao informado!");
if (empty($subject))
    messageBox($caption, "Nao foi possivel enviar o email: Assunto do email nao informado!");
if (empty($text))
    messageBox($caption, "Nao foi possivel enviar o email: Texto do email nao informado!");

// Tenta enviar o email usando PHPMailer
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $host;                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $userName;               // SMTP username
    $mail->Password = $password;                         // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($emailFrom);
    $mail->addAddress($emailTo);     // Add a recipient
    if (!empty($emailCc))
        $mail->addCC($emailCc);
    if (!empty($emailCco))
        $mail->addBCC($emailCco);
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $text;
    $mail->AltBody = $text;

    $mail->send();

    // Salva os dados de conexao com servidor SMTP no browser do usuario
    echo "<script src=\"localstorage.js\"></script>\n"; 
    echo "<script>\n";
    echo "writeLocalStorage('host', '" . $host . "');\n";
    echo "writeLocalStorage('porta', '" . $port . "');\n";
    echo "writeLocalStorage('usuario', '" . $userName . "');\n";
    echo "writeLocalStorage('senha', '" . $password . "');\n";
    echo "</script>\n";

    messageBox("Aviso", "Mensagem enviada com sucesso!");
} catch (Exception $e) {
    messageBox("Erro", $mail->ErrorInfo);
}

?>
