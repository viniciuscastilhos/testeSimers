<?php

  if (file_exists('user.xml'))
    {
    $xml = simplexml_load_file('user.xml');
    foreach($xml->user as $dados)
      { if($dados['status']=='1')
          {
          echo "<table style='font-family : arial; font-weight : bold; background : #CACACA;'>";
          echo "<tr><td style='border : thin solid #ffffff;'>Status: </td><td style='border : thin solid #ffffff;'>" . $dados['status'] . "</td></tr>";
	      echo "<tr><td style='border : thin solid #ffffff;'>E-mail: </td><td style='border : thin solid #ffffff;'>" . $dados['email'] . "</td></tr>";
	      echo "<tr><td style='border : thin solid #ffffff;'>Senha: </td><td style='border : thin solid #ffffff;'>" . $dados['senha'] . "</td></tr>";
	      echo "<tr><td style='border : thin solid #ffffff;'>Usuario: </td><td style='border : thin solid #ffffff;'>" . $dados['usuario'] . "</td></tr>";
	      echo "<tr><td style='border : thin solid #ffffff;'>Sobre nome: </td><td style='border : thin solid #ffffff;'>" . $dados['sobrenome'] . "</td></tr>";
	      echo "<tr><td style='border : thin solid #ffffff;'>Nome: </td><td style='border : thin solid #ffffff;'>" . $dados['nome'] . "</td></tr>";
	      echo "<tr><td style='border : thin solid #ffffff;'>Id: </td><td style='border : thin solid #ffffff;'>" . $dados['id'] . "</td></tr>";
	      echo "</table><br>";
	      }
       }
    }
  else
    {
    exit('Falha ao abrir o arquivo.');
    }


 // Criei uma conexão com o MySql simples para simples demonstração
  function conecta()
  {
   $sock = mysql_connect('localhost','root','');
   if(!$sock)
     {echo "<script>alert('Erro ao conectar banco de dados!')<script>";
      echo "<script>ducument.location.replace('mostraUsuarios.php')<script>";
      exit; }

    if(!mysql_select_db('testeSimers',$sock))
      {echo "<script>alert('Erro ao selecionar banco de dados!')<script>";
       echo "<script>ducument.location.replace('mostraUsuarios.php')<script>";
       exit; }
   
  }

  //Elaborei uma função/script de inserção de dados para simples demonstração
  function insere_dados()
  {
    echo conecta();
    foreach($xml->user as $dados)
      {
	      $status = $dados['status'];
	      $email = $dados['email'];
	      $senha = $dados['senha'];
	      $usuario = $dados['usuario'];
	      $sobrenome = $dados['sobrenome'];
	      $nome = $dados['nome'];
          $idXml = $dados['id'];
          
          $insert = "insert into userlist values(NUll, '$status', '$email', '$senha', '$usuario',
                                                '$sobrenome', '$nome', '$idXml')";
                                                
          if(!mysql_query($insert,$sock))
            {echo "<script> alert('Erro no cadastro')</script>";
             echo mysql_error($sock);}
       }

  }
  
  // Elaborei uma função que executa uma pesquisa no BD, conforme solicitado nas regras
  function pesquisa_banco()
  {
   echo conecta();
   $pesquisa = "select id, status, email, senha, usuario, sobrenome, nome, idXml
                from userlist
                where status=1";
                
   if(!$resultado_pesquisa = mysql_query($pesquisa,$sock))
      {
       echo "<script>alert('Erro ao efetuar pesquisa!')<script>";
       echo "<script>ducument.location.replace('mostraUsuarios.php')<script>";
       exit;
      }
   while ($dados_pesquisa = mysql_fetch_array($resultado_pesquisa,MYSQL_ASSOC))
       {
        $id         = $dados_pesquisa['id'];
        $status     = $dados_pesquisa['status'];
        $email      = $dados_pesquisa['email'];
        $senha      = $dados_pesquisa['senha'];
        $usuario    = $dados_pesquisa['usuario'];
        $sobrenome  = $dados_pesquisa['sobrenome'];
        $nome       = $dados_pesquisa['nome'];
        $idXml      = $dados_pesquisa['idXml'];
        
        echo "<table style='font-family : arial; font-weight : bold; background : #CACACA;'>";
        echo "<tr><td style='border : thin solid #ffffff;'>Status: </td><td style='border : thin solid #ffffff;'>" . $id . "</td></tr>";
	    echo "<tr><td style='border : thin solid #ffffff;'>E-mail: </td><td style='border : thin solid #ffffff;'>" . $status . "</td></tr>";
	    echo "<tr><td style='border : thin solid #ffffff;'>Senha: </td><td style='border : thin solid #ffffff;'>" . $email . "</td></tr>";
	    echo "<tr><td style='border : thin solid #ffffff;'>Usuario: </td><td style='border : thin solid #ffffff;'>" . $senha . "</td></tr>";
	    echo "<tr><td style='border : thin solid #ffffff;'>Sobre nome: </td><td style='border : thin solid #ffffff;'>" . $usuario . "</td></tr>";
	    echo "<tr><td style='border : thin solid #ffffff;'>Nome: </td><td style='border : thin solid #ffffff;'>" . $sobrenome . "</td></tr>";
	    echo "<tr><td style='border : thin solid #ffffff;'>Id: </td><td style='border : thin solid #ffffff;'>" . $nome . "</td></tr>";
        echo "<tr><td style='border : thin solid #ffffff;'>Id: </td><td style='border : thin solid #ffffff;'>" . $idXml . "</td></tr>";
        echo "</table><br>";

       }
     }
?>
