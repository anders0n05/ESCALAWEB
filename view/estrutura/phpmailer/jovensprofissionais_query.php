<?php
session_start();
if(isset($_POST['nome'])){
	$nome = $_POST['nome'];
}
else{
	$nome = null;
}
if(isset($_POST['cpf'])){
	$cpf = $_POST['cpf'];
}
else{
	$cpf = null;
}
if(isset($_POST['datanasc'])){
	$datanasc = $_POST['datanasc'];
}
else{
	$datanasc = null;
}
if(isset($_POST['telefone'])){
	$telefone = $_POST['telefone'];
}
else{
	$telefone = null;	
}
if(isset($_POST['celular'])){
	$celular = $_POST['celular'];
}
else{
	$celular = null;
}
if(isset($_POST['cidadeuf'])){
	$cidadeuf = $_POST['cidadeuf'];
}
else{
	$cidadeuf = null;
}	
if(isset($_POST['email'])){
	$email = $_POST['email'];
}
else{
	$email = null;
}
if(isset($_POST['obs'])){
	$obs = $_POST['obs'];
}
else{
	$obs = null;
}  
if(isset($_POST['programa'])){
	$programa = $_POST['programa'];
}
else{
	$programa = null;
}  

if($email == null || $nome == null){
	$_SESSION['retorno'] = "Preencha os dados para enviar seu email";
	header('Location:jovensprofissionais.php');
	exit;
}

if($email == null || $nome == null){
	$_SESSION['retorno'] = "Preencha os dados para enviar seu email";
	header('Location:jovensprofissionais.php');
	exit;
}

if($_FILES["curriculo"]["size"] > 0){
	
    $destino = "uploads/curriculo/";
	
	$curriculo = 'Curriculo '.$nome.' - '.date('d-m-Y H:i:s').'.'.end(explode(".", $_FILES["curriculo"]["name"]));

    move_uploaded_file($_FILES["curriculo"]["tmp_name"], ($destino.$curriculo));
}


//PHP MAILER
// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require("phpmailer/class.phpmailer.php");
require("phpmailer/class.smtp.php");
 
// Inicia a classe PHPMailer
$mail = new PHPMailer(true);
 
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
//$mail->Host = "localhost"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
$mail->Username = 'naoresponder@escalasoft.com.br'; // Usuário do servidor SMTP (endereço de email)
$mail->Password = '#acesso123'; // Senha do servidor SMTP (senha do email usado)
$mail->Port = '587';
$mail->Host = 'mail.escalasoft.com.br';
 
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = $email; // Seu e-mail
$mail->Sender = $email; // Seu e-mail
$nome = $nome;
$mail->FromName = utf8_decode($nome); // Seu nome
 
// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress('recrutamento@escalasoft.com.br', 'RH Escalasoft tecnologia');
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
 
// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
 
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$assunto = "Solicitação de cadastro no programa jovens profissionais";
$mail->Subject  = utf8_decode($assunto); // Assunto da mensagem
$mail->AddEmbeddedImage('images/logoemail.png', 'logoemail');
$corpo = '
 	<h2>Solicitação de '.$nome.'</h2>
	
	Nome: '.$nome.'
	<br />
	CPF: '.$cpf.'
	<br />
	Data de nasc: '.$datanasc.'
	<br />
	Telefone: '.$telefone.'
	<br />
	Celular: '.$celular.'
	<br />
	Cidade / UF: '.$cidadeuf.'
	<br />
	E-mail: '.$email.'
	<br />
	Programa: '.$programa.'
	<br /><br />
	Observações: '.$obs.'
	<br />
	<br />
    Currículo salvo no ftp
    <br />
    <a href="http://www.escalasoft.com.br/uploads/curriculo/'.$curriculo.'">Visualizar online</a>
	<br /><br /><br />
	E-mail enviado pelo website!
	<br /><br />
	<img src="cid:logoemail" alt="Escalasoft Tecnologia">
	';
		
$mail->Body = utf8_decode($corpo);
 
// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
if(isset($curriculo)){

$mail->AddAttachment("uploads/curriculo/".$curriculo, $nome_curriculo);

}
// Envia o e-mail
try
{
	$enviado = $mail->Send();
	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	
	// Exibe uma mensagem de resultado
	
	$_SESSION['retorno'] = "Inscrição enviada com sucesso!";
	header('Location:jovensprofissionais.php');	
}
catch (Exception $e)
{	
	$_SESSION['retorno'] = "Erro ao enviar a solicitação. Por favor, tente mais tarde. ".$e->getMessage();
	header('Location:jovensprofissionais.php');
}

?>