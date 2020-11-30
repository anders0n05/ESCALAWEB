<?php

include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

if(isset($_POST['CPF'])){
	$cpf = $_POST['CPF'];
}
else{
	$cpf = null;
}

//BUSCA CPF

$queryBuscaCurriculoCPF = $connect->prepare("SELECT 
							  A.HANDLE HANDLE, 	
						      A.CPF CPF, 
							  A.EMAIL EMAIL 
						FROM 
						  	  RC_CURRICULO A
						WHERE
							  A.CPF = '$cpf'
						AND   A.STATUS <> 6");

$queryBuscaCurriculoCPF->execute();

$rowCurriculoCPF	= $queryBuscaCurriculoCPF->fetch(PDO::FETCH_ASSOC);	
$handleCurriculo	= $rowCurriculoCPF['HANDLE'];
$cpfCompara			= $rowCurriculoCPF['CPF'];
$emailCadastro		= $rowCurriculoCPF['EMAIL'];


if ($cpf == $cpfCompara) {

	$bytes = openssl_random_pseudo_bytes(5);
	$senhaNova = bin2hex($bytes);

	WebService::setupCURL("recrutamento/curriculo/alterarsenha", [
		"HANDLE"	=> $handleCurriculo,
		"CPF"		=> $cpfCompara,
		"SENHAWEB"	=> $senhaNova
	]);

	WebService::execute();

	$body = WebService::getBody();

	$dados = json_decode($body, true);

	if (isset($dados["Mensagem"])) {
		echo $dados["Mensagem"];
	} else {
		echo Sistema::retornoJson(500, $body);
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
	$mail->Username = 'falecom@escalatalentos.com.br'; // Usuário do servidor SMTP (endereço de email)
	$mail->Password = '#mailtalentosfalecom123'; // Senha do servidor SMTP (senha do email usado)
	$mail->Port = '587';
	$mail->Host = 'mail.escalatalentos.com.br';
	 
	// Define o remetente
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->From = "recrutamento@escalatalentos.com.br"; // Seu e-mail
	$mail->Sender = "recrutamento@escalatalentos.com.br";// Seu e-mail
	$cpf = "Escalatalentos";
	$mail->FromName = utf8_decode($cpf); // Seu nome
	 
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($emailCadastro, 'Alteração de senha Escalatalentos');
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	 
	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
	 
	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$assunto = 'Nova senha de acesso - Currículo Escalatalentos';
	$mail->Subject  = utf8_decode($assunto); // Assunto da mensagem
	$corpo = '
	 	<h2>Nova senha de acesso - Currículo Escalatalentos</h2>
		Olá!
		<br />
		Segue abaixo senha de acesso atualizada:
		<br />
		Senha: '.$senhaNova.'
		<br />
		Caso tenha qualquer tipo de dúvida, contate o setor administrativo da Escalatalentos.
		<br />
		<br /><br />
		';
			
	$mail->Body = utf8_decode($corpo);
	// Envia o e-mail
	try
	{
		$enviado = $mail->Send();
		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		//$mail->ClearAttachments();
	echo '<script type="text/javascript">';
	echo 'alert("Nova senha enviada para o email: '.$emailCadastro.'")';
	echo '</script>';
	?>
	 <script type="text/javascript">
		window.location.href = 'acesso.php';
	</script>
	<?php } catch (Exception $e) {	
	?>
	<script type="text/javascript">
		alert("Erro ao enviar o currículo. Por favor, tente mais tarde");
		window.location.href = 'novasenhacurriculo.php';
	</script>
	<?php
	}
} else { ?>
  	<script type="text/javascript">
		alert("Seu CPF não consta em nossa base de dados, cadastre um novo curriculo");
		window.location.href = 'cadastrar.php';
	</script>
<?php } ?>