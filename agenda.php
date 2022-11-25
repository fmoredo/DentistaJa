<?php
$procedimento = $_POST['procedimento'];
$data = $_POST['data'];
$login = $_POST['login'];
$horario = $_POST['horario'];
$data_agenda = date('Y-m-d H:i:s', strtotime("$data $horario"));
$agenda = $_POST['agenda'];
$sname= "localhost";
$uname="root";
$password="";
$db_name="producao";
$conn=mysqli_connect($sname,$uname,$password,$db_name);

  if (isset($agenda)) {
	  
	$hr_duracao = $conn->query("SELECT hr_duracao FROM procedimento WHERE cd_procedimento = $procedimento")->fetch_object()->hr_duracao;
	$cd_paciente =  $conn->query("SELECT cd_paciente FROM paciente WHERE usuario = '$login'")->fetch_object()->cd_paciente;
	if ($hr_duracao==1){
		$data_nova = date('Y-m-d H:i:s', strtotime($data_agenda.'+1 hour'));
	}
	if ($hr_duracao==2){
		$data_nova = date('Y-m-d H:i:s', strtotime($data_agenda.'+2 hour'));
	}
	if ($hr_duracao==3){
		$data_nova = date('Y-m-d H:i:s', strtotime($data_agenda.'+3 hour'));
	}
	$verifica_agenda = mysqli_query($conn,"SELECT * FROM agenda WHERE dt_procedimento>'$data_agenda' and dt_procedimento<'$data_nova'");
	$verifica_usuario = mysqli_query($conn,"SELECT * FROM paciente WHERE usuario='$login'");
      if (mysqli_num_rows($verifica_agenda)<=0 and mysqli_num_rows($verifica_usuario)==1){
		
		$sql = "INSERT INTO agenda(cd_paciente,cd_procedimento,dt_procedimento,dt_fim_procedimento) 
		values ('$cd_paciente','$procedimento','$data_agenda','$data_nova')";
		$res = mysqli_query($conn,$sql);
		if ($res){
			echo "<SCRIPT>
			window.location.replace('pagamento.html');
			</SCRIPT>";
		}
		else{
			echo "<SCRIPT> //not showing me this
			alert('Erro no agendamento, por favor tentar novamente.')
			window.location.replace('agenda.html');
			</SCRIPT>";;
		}		

  }
  }
	else{
        echo "Erro no agendamento, por favor retornar e tentar novamente.";
  }
?>