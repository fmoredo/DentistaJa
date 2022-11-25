 <?php
 
 if (isset($_POST['usuario']) && isset($_POST['senha']) && isset($_POST['nm_paciente']) &&
 isset($_POST['email']) && isset($_POST['dt_nascimento']) && isset($_POST['sexo']) && isset($_POST['celular'])
 && isset($_POST['cep']) && isset($_POST['endereco']) && isset($_POST['nr_endereco']) && isset($_POST['complemento'])
 && isset($_POST['cpf']) && isset($_POST['rg']) && isset($_POST['estado']) && isset($_POST['cidade'])) {
	 include 'db_conexao.php';
	 function validate($data){
		 $data = trim($data);
		 $data = stripslashes($data);
		 $data = htmlspecialchars($data);
		 return $data;
	 }
	 $usuario = validate(strtoupper($_POST['usuario']));
	 $senha = validate(strtoupper($_POST['senha']));
	 $nm_paciente = validate(strtoupper($_POST['nm_paciente']));
	 $email = validate(strtoupper($_POST['email']));
	 $dt_nascimento = validate(strtoupper($_POST['dt_nascimento']));
	 $sexo = validate(strtoupper($_POST['sexo']));
	 $celular = validate(strtoupper($_POST['celular']));
	 $cep = validate(strtoupper($_POST['cep']));
	 $endereco = validate(strtoupper($_POST['endereco']));
	 $nr_endereco = validate(strtoupper($_POST['nr_endereco']));
	 $complemento = validate(strtoupper($_POST['complemento']));
	 $cpf = validate(strtoupper($_POST['cpf']));
	 $rg = validate(strtoupper($_POST['rg']));
	 $estado = validate(strtoupper($_POST['estado']));
	 $cidade = validate(strtoupper($_POST['cidade']));
	 
	 if (empty($usuario)||empty($senha)||empty($nm_paciente)||empty($email)||empty($dt_nascimento)||empty($sexo)||empty($celular)||
	 empty($cep)||empty($endereco)||empty($nr_endereco)||empty($complemento)||empty($cpf)||empty($rg)||empty($estado)||empty($cidade)){
		 header("Location: index.html");
	 }
	 else{	
		 $sql = "INSERT INTO paciente(usuario,senha,nm_paciente,email,dt_nascimento,sexo,celular,cep,endereco,nr_endereco,complemento,cpf,rg,estado,cidade) 
		 VALUES('$usuario','$senha','$nm_paciente','$email','$dt_nascimento','$sexo','$celular','$cep','$endereco','$nr_endereco','$complemento','$cpf','$rg','$estado','$cidade')";
		 $res = mysqli_query($conn,$sql);
		 if ($res){
			 echo "<SCRIPT> //not showing me this
				alert('Cadastro realizado.')
				window.location.replace('login.html');
				</SCRIPT>";
		 }
		 else{
			 echo "Erro no cadastro, por favor retornar e tentar novamente.";
		 }
	 }
	 
 }
 else {
	 header("Location: index.html");
 }