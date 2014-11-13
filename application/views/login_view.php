<div align="center">
	<h1>
		<?=$message ?>
	</h1>
        <?php if($ask_password) { ?>
	<form name="login_form" method="post" action="login">
	   <label for="username">Username:</label> <input type="text" id="username" name="username" value="musicadmin" disabled="disabled" /><br />
	   <input type="hidden" id="username" name="username" value="musicadmin" />
	   <label for="password">Password:</label> <input type="password" id="password" name="password" /><br />
	   <button type="submit">Log In</button>
	</form>
	<script type="text/javascript">document.login_form.password.focus();</script>
        <?php } ?>
	<a href="<?=$referrer?>">Go back</a>
</div>