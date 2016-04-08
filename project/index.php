<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="author" content="Chaki Abderrazak" />
	<title>Identification</title>
  </head>
  <body>
    <form action="authentification.php<?php //echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
      <fieldset>
        <legend>Identifiant</legend>
		  <p>
            <label for="login">Login :</label> 
				<input type="text" placeholder="Nom utilisateur" name="NomClient" id="login"  value="<?php if(!empty($_POST['login'])) { echo htmlspecialchars($_POST['login'], ENT_QUOTES); } ?>" required><br />
          </p>	
		  <p>
            <label for="password">Mot de passe :</label> 
            <input type="password" placeholder="Mot de passe" name="MdpClient" id="MdpClient" value="" required /> 
            <input type="submit" name="submit" value="Se connecter" />
          </p>	
      </fieldset>
    </form>
  </body>
</html>
