<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Load composer's autoloader
    require 'vendor/autoload.php';
    require_once 'util.php';

    // Accept only POST method!!!
    $prefixMessage = "Nao foi possivel enviar o email:";
    if ($_SERVER['REQUEST_METHOD'] != "POST")
        die ($prefixMessage + " Dados enviados do formulario de forma incorreta!");

    // Get and check required fields
    $caption = "Erro";
  
    $host = $_POST['host'];
    if (empty($host))
        messageError($prefixMessage . " Servidor SMTP nao informado!");

    $port = $_POST['port'];
    if (empty($port))
        messageError($prefixMessage . " Porta do servidor de envio de email nao informada!");

    $userName = $_POST['user'];
    if (empty($userName))
        messageError($prefixMessage . " Usuario para autenticacao com servidor de email nao informado!");

    $password = $_POST['passwd'];
    if (empty($password))
        messageError($prefixMessage . " Senha para autenticacao com servidor de email nao informada!");
        
    $emailFrom = $_POST['from'];
    if (empty($emailFrom))
        messageError($prefixMessage . " Email do usuario de envio nao informado!");

    $emailTo = $_POST['to'];
    if (empty($emailTo))
        messageError($prefixMessage . " Email do destinatario nao informado!");

    $subject = $_POST['subject'];
    if (empty($subject))
        messageError($prefixMessage . " Assunto do email nao informado!");
 
    $text = $_POST['text'];
    if (empty($text))
        messageError($prefixMessage . " Texto do email nao informado!");

    // Get optional fields
    $emailCc = $_POST['cc'];
    $emailCco = $_POST['cco'];
        
    // Try to send email
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $host;                                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $userName;                          // SMTP username
        $mail->Password = $password;                          // SMTP password
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
        $mail->isHTML(true);                                    // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $text;
        $mail->AltBody = $text;

        $mail->send();

        messageAlert("Mensagem enviada com sucesso!");
    } catch (Exception $e) {
        messageError($mail->ErrorInfo);
    }
?>
