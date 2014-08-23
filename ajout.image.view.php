<form class="formajout" id="login" action="index.php" method="post" accept-charset="UTF-8">
	<fieldset>
		<ol>
			<li>
				<label for="nomObjet">Nom de l'objet:</label>
				<input type="text" name="nomObjet" id="nomObjet" value="<?php echo $_POST["nomObjet"]?>" required="required">
				<span class="error"><?php echo($_SESSION["bugNomObjet"] )?></span>
			</li>
			
			<li class="nbjour"><label for="nbJour">Chance de survie:</label>						
				<select name="nbJour">
				  <option value="0">-5 Jours</option> 
				  <option value="1">-4 Jours</option>
				  <option value="2">-3 Jours</option>
				  <option value="3">-2 Jours</option>
				  <option value="4">-1 Jour</option>
				  <option value="5" selected>0 Jours</option>
				  <option value="6">1 Jour</option>
				  <option value="7">2 Jours</option>
				  <option value="8">3 Jours</option>
				  <option value="9">4 Jours</option>
				  <option value="10">5 Jours</option>
				</select>
			</li>
							
			<li class="cat"><label for="select">Catégorie:</label>	
				<select name="select">
				  <option value="0" selected>Arme</option> 
				  <option value="1">Nourriture</option>
				  <option value="2">Outil</option>
				  <option value="3">Soin</option>
				  <option value="4">Savoir</option>
				  <option value="5">Pnj</option>
				  <option value="6">Autre</option>
				</select>
			</li>
			
			<li>
				<label for="description">Utilisation:</label><textarea rows="4" cols="26" name="description" id="description"  placeholder="Ex: Vous mangez un champignon. Pas de chance, il était vénéneux." required="required"><?php echo $_POST["description"]?></textarea>
				<span class="error"><?php echo($_SESSION["bugDescription"] );?></span>
			</li>
			
			<li class="clear"><input type="submit" name="saveObjet" value="Sauvegarder l'objet"></li>
			<!--<li class="cancel"><input type="submit" name="cancel" value="Annuler"></li>-->
		</ol>
	</fieldset>
</form>