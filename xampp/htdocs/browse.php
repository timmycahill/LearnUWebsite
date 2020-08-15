<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Learn U | Browse</title>
		<link href="stylesheets/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <link href="stylesheets/browse.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
	</head>
    
<?php
    include 'header.php';
?>

<h1>Choose a Topic:</h1>
<div class="topics">

    <a href="courseList.php?lang=cpp">
        <div class="topic">
            <img src="images/browseLogos/CppLogo.png">
            <p>C++</p>
        </div>
    </a>

    <a href="courseList.php?lang=java">
        <div class="topic">
            <img src="images/browseLogos/JavaLogo.png">
            <p>Java</p>
        </div>
    </a>

    <a href="courseList.php?lang=python">
        <div class="topic">
            <img src="images/browseLogos/PythonLogo.png">
            <p>Python</p>
        </div>
    </a>

    <a href="courseList.php?lang=git">
        <div class="topic">
            <img src="images/browseLogos/GitLogo.png">
            <p>Git</p>
        </div>
    </a>
</div>

<div class="topics">
    <a href="courseList.php?lang=html">
        <div class="topic">
            <img src="images/browseLogos/HtmlLogo.png">
            <p>HTML</p>
        </div>
    </a>

    <a href="courseList.php?lang=css">
        <div class="topic">
            <img src="images/browseLogos/CssLogo.png">
            <p>CSS</p>
        </div>
    </a>

    <a href="courseList.php?lang=javascript">
        <div class="topic">
            <img src="images/browseLogos/JavascriptLogo.png">
            <p>JavaScript</p>
        </div>
    </a>

    <a href="courseList.php?lang=php">
        <div class="topic">
            <img src="images/browseLogos/PhpLogo.png">
            <p>PHP</p>
        </div>
    </a>
</div>

<?php
    include 'footer.php';
?>