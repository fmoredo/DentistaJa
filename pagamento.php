<?php
$numero = $_POST['numero'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$nome = strtoupper($_POST['nome']);
$pagar = $_POST['pagar'];
$cvv = $_POST['cvv'];
$sname= "localhost";
$uname="root";
$password="";
$db_name="producao";
$conn=mysqli_connect($sname,$uname,$password,$db_name);

  if (isset($pagar)) {	
	$max_cd_agenda =  $conn->query("SELECT max(cd_agenda) cd_agenda FROM agenda")->fetch_object()->cd_agenda;
	$nm_paciente =  $conn->query("SELECT p.nm_paciente from (SELECT max(cd_agenda) cd_agenda FROM agenda) x inner join agenda a on x.cd_agenda=a.cd_agenda inner join paciente p on a.cd_paciente=p.cd_paciente")->fetch_object()->nm_paciente;
	$procedimento =  $conn->query("SELECT p.ds_procedimento from (SELECT max(cd_agenda) cd_agenda FROM agenda) x inner join agenda a on x.cd_agenda=a.cd_agenda inner join procedimento p on a.cd_procedimento=p.cd_procedimento")->fetch_object()->ds_procedimento;
	$hr_inicio =  $conn->query("SELECT a.dt_procedimento from (SELECT max(cd_agenda) cd_agenda FROM agenda) x inner join agenda a on x.cd_agenda=a.cd_agenda")->fetch_object()->dt_procedimento;
	$hr_fim =  $conn->query("SELECT a.dt_fim_procedimento from (SELECT max(cd_agenda) cd_agenda FROM agenda) x inner join agenda a on x.cd_agenda=a.cd_agenda")->fetch_object()->dt_fim_procedimento;

	
	$sql = "INSERT INTO pagamento(cd_agenda,nr_cartao,mes,ano,nm_titular,cvv) 
	values ('$max_cd_agenda','$numero','$mes','$ano','$nome','$cvv')";
	$res = mysqli_query($conn,$sql);
	if ($res){
		echo '<div style="font-size:1.25em;color:#0e3c68;font-weight:bold;">AGENDAMENTO CONCLUÍDO COM SUCESSO!</span></div>';
		echo nl2br("\n\nNome do paciente: $nm_paciente \n");
		echo nl2br("Procedimento agendado: $procedimento \n");
		echo nl2br("Data início procedimento: $hr_inicio \n");
		echo nl2br("Data fim procedimento: $hr_fim \n");
	}
	else{
		echo "<SCRIPT> 
		alert('Erro no pagamento, por favor tentar novamente.')
		window.location.replace('pagamento.html');
		</SCRIPT>";;
	}		
  } 
  
  else{
    echo "Erro no pagamento, por favor retornar e tentar novamente.";
  }
?>