<?php 
/*if(isset($_POST['name']))
{
	echo 'submitted';
}*/

session_start();
if(isset($_POST['name']))
{
	if(isset($_SESSION['BOOKMARKS'])){
		$_SESSION['BOOKMARKS'][$_POST['name']]=$_POST['url'];
		ksort($_SESSION['BOOKMARKS']);
	}
	else{
		$_SESSION['BOOKMARKS']=array($_POST['name'] => $_POST['url']);
	}
}
if(isset($_GET['action']) && $_GET['action']=='delete')
{
	unset($_SESSION['BOOKMARKS'][$_GET['name']]);
	header("Location:index.php");
}
if(isset($_GET['action']) && $_GET['action']=='Clear')
{
	session_unset();
	session_destroy();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>BookMarker</title>
	<link rel="stylesheet" href="https://bootswatch.com/cyborg/bootstrap.min.css">
</head>
<body >
<nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Bookmarker</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php?action=Clear">Clear All</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div class="container">
	<div class="row">
		<div class="col-md-7">
			<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label>Website Name</label>
					<input type="text" class="form-control" name="name">
					<label>Website URL</label>
					<input type="text" class="form-control" name="url">
				</div>
				<input type="submit" value="submit" class="btn btn-default">
			</form>
		</div>
		<div class="col-md-5">
			<?php if(isset($_SESSION['BOOKMARKS'])): ?>
				<ul class="list-group">
			<?php foreach ($_SESSION['BOOKMARKS'] as $bookmark=> $url) : ?>
				<li class="list-group-item">
					<a href="<?php echo $url; ?>" target="_blank"><?php echo $bookmark; ?></a><a href="index.php?action=delete&name=<?php echo $bookmark?>"> [X] </a>
				</li>
			<?php endforeach;?>
			</ul>
			<?php endif; ?>
			
		</div>
	</div>
</div>
</body>
</html>
