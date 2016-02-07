<?php

namespace Rudolf\Modules\login;

class LoginView {
	public function form() {
		?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>log in</title>
	</head>
	<body>
		<h1>log in</h1>
		<form action="" method="get">
			<p><input type="text"/ name="nick"></p>
			<p><input type="password" name="password"></p>
			<p><input type="submit"/></p>
		</form>
	</body>
</html>
<?php
	}
}
