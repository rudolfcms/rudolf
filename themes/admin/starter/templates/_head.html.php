<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php ?>Dashboard | Starter theme for admin in lcms</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="./">Zespół Szkół w Rokietnicy</a>
		</div>
		<div class="navbar-collapse collapse">
		  <ul class="nav navbar-nav navbar-right">
		    <li><a href="./" onclick="target='new'"><span class="glyphicon glyphicon-eye-open"></span><span class="b">Strona</span></a></li>
			<li ><a href="?module=configuration"><span class="glyphicon glyphicon-cog"></span><span class="b">Ustawienia</span></a></li>
			<li ><a href="?module=help"><span class="glyphicon glyphicon-question-sign"></span><span class="b">Pomoc</span></a></li>
			<li ><a href="?module=profile"><span class="glyphicon glyphicon-user"></span><span class="b">Profil</span></a></li>
			<li><a href="./?action=logout"><span class="glyphicon glyphicon-off"></span><span class="b">Wyloguj się</span></a></li>
		  </ul>
		</div>
	  </div>
	</div>
	<div class="container-fluid">
	<div class="row">
	<div class="col-sm-3 col-md-2 sidebar">
	  <ul class="nav nav-sidebar">
	
		<li class="active">
		  <a data-toggle="collapse" data-target="#home"><span class="glyphicon glyphicon-dashboard"></span><span class="s">Panel zarządzania</span> <span class="pull-right caret" style="margin-top:8px"></span></a>
		  <div id="home" class="collapse in">
			<ul class="nav nav-sidebar" style="margin-left:20px;">
			  <li class="active">
				<a href="./"><span class="glyphicon glyphicon-home"></span><span class="s">Przegląd</span></a>
			  </li>
			  <li >
				<a href="?module=configuration"><span class="glyphicon glyphicon-cog"></span><span class="s">Ustawienia</span></a></li>
			  <li >
				<a href="?module=tools"><span class="glyphicon glyphicon-compressed"></span><span class="s">Narzędzia</span></a></li>
			  <li >
				<a href="?module=help"><span class="glyphicon glyphicon-question-sign"></span><span class="s">Pomoc</span></a></li>
			</ul>
		  </div>
		</li>
		
		<li >
		  <a data-toggle="collapse" data-target="#articles"><span class="glyphicon glyphicon-pencil"></span><span class="s">Wpisy</span> <span class="pull-right caret" style="margin-top:8px"></span></a>
		  <div id="articles" class="collapse">
			<ul class="nav nav-sidebar" style="margin-left:20px;">
			  <li >
				<a href="?module=articles"><span class=" glyphicon glyphicon-th"></span><span class="s">Lista wpisów</span></a>
			  </li>
			  <li >
				<a href="?module=articles&amp;action=add"><span class="glyphicon glyphicon-plus"></span><span class="s">Dodaj wpis</span></a>
			  </li>
			</ul>
		  </div>
		</li>
				
		<li >
		  <a data-toggle="collapse" data-target="#pages"><span class="glyphicon glyphicon-folder-open"></span><span class="s">Strony</span> <span class="pull-right caret" style="margin-top:8px"></span></a>
		  <div id="pages" class="collapse">
			<ul class="nav nav-sidebar" style="margin-left:20px;">
			  <li >
				<a href="?module=pages"><span class="glyphicon glyphicon-th-list"></span><span class="s">Lista stron</span></a>
			  </li>
			  <li >
				<a href="?module=pages&amp;action=add"><span class="glyphicon glyphicon-plus"></span><span class="s">Dodaj stronę</span></a>
			  </li>
			</ul>
		  </div>
		</li>
		
		<li >
		  <a data-toggle="collapse" data-target="#albums"><span class="glyphicon glyphicon-picture"></span><span class="s">Albumy</span> <span class="pull-right caret" style="margin-top:8px"></span></a>
		  <div id="albums" class="collapse">
			<ul class="nav nav-sidebar" style="margin-left:20px;">
			  <li >
				<a href="?module=albums"><span class="glyphicon glyphicon-th-list"></span><span class="s">Lista albumów</span></a>
			  </li>
			  <li >
				<a href="?module=albums&amp;action=add"><span class="glyphicon glyphicon-plus"></span><span class="s">Dodaj album</span></a>
			  </li>
			</ul>
		  </div>
		</li>
				
		<li >
		  <a data-toggle="collapse" data-target="#galleries"><span class="glyphicon glyphicon-camera"></span><span class="s">Galerie</span> <span class="pull-right caret" style="margin-top:8px"></span></a>
		  <div id="galleries" class="collapse">
			<ul class="nav nav-sidebar" style="margin-left:20px;">
			  <li >
				<a href="?module=galleries"><span class="glyphicon glyphicon-th-list"></span><span class="s">Lista galerii</span></a>
			  </li>
			  <li >
				<a href="?module=galleries&amp;action=add"><span class="glyphicon glyphicon-plus"></span><span class="s">Dodaj galerię</span></a>
			  </li>
			</ul>
		  </div>
		</li>
		
		<li >
		  <a data-toggle="collapse" data-target="#publicInformationBulletin"><span class="glyphicon glyphicon-info-sign"></span><span class="s">BIP</span> <span class="pull-right caret" style="margin-top:8px"></span></a>
		  <div id="publicInformationBulletin" class="collapse">
			<ul class="nav nav-sidebar" style="margin-left:20px;">
			  <li >
				<a href="?module=publicInformationBulletin"><span class="glyphicon glyphicon-th-list"></span><span class="s">Lista stron</span></a>
			  </li>
			  <li >
				<a href="?module=publicInformationBulletin&amp;action=add"><span class="glyphicon glyphicon-plus"></span><span class="s">Dodaj stronę</span></a>
			  </li>
			</ul>
		  </div>
		</li>
				
		<li ><a href="?module=guestbook">
		  <span class="glyphicon glyphicon-book"></span><span class="s">Księga gości</span> </a></li>
				
		<li ><a href="?module=bugreport">
		  <span class="glyphicon glyphicon-gift"></span><span class="s">Zgłaszanie błędów</span> </a></li>
				
		<li ><a href="?module=modules">
		  <span class="glyphicon glyphicon-tasks"></span><span class="s">Moduły</span></a></li>
		  
		<li >
		  <a data-toggle="collapse" data-target="#appearance"><span class="glyphicon glyphicon-tint"></span><span class="s">Wygląd</span> <span class="pull-right caret" style="margin-top:8px"></span></a>
		  <div id="appearance" class="collapse">
			<ul class="nav nav-sidebar" style="margin-left:20px;">
			  <li >
				<a href="?module=appearance"><span class="glyphicon glyphicon-th-list"></span><span class="s">Lista szablonów</span></a>
			  </li>
			  <li >
				<a href="?module=appearance&amp;action=customize"><span class="glyphicon glyphicon-wrench"></span><span class="s">Dostosowywanie</span></a>
			  </li>
			</ul>
		  </div>
		</li>
		
		<li >
		  <a data-toggle="collapse" data-target="#users"><span class="glyphicon glyphicon-user" style="left:-5px"></span><span class="glyphicon glyphicon-user" style="left:-10px"></span><span class="s" style="margin-left:0px">Użytkownicy</span> <span class="pull-right caret" style="margin-top:8px"></span></a>
		  <div id="users" class="collapse">
			<ul class="nav nav-sidebar" style="margin-left:20px;">
			  <li >
				<a href="?module=users"><span class="glyphicon glyphicon-th-list"></span><span class="s">Lista użytkowników</span></a>
			  </li>
			  <li >
				<a href="?module=profile"><span class="glyphicon glyphicon-user"></span><span class="s">Profil</span></a>
			  </li>
			  <li >
				<a href="?module=users&amp;action=add"><span class="glyphicon glyphicon-plus"></span><span class="s">Dodaj użytkownika</span></a>
			  </li>
			</ul>
		  </div>
		</li>
		
		<li ><a href="?module=filemanager">
		  <span class="glyphicon glyphicon-upload"></span><span class="s">Menadżer plków</span></a></li>
	  </ul>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="top:-20px">
	  <div class="page-header"><h1>Przegląd <small>Panel zarządzania</small></h1></div>

	<div class="col-md-8">