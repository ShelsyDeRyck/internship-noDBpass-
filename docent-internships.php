<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internships</title>
    <link rel="stylesheet" href="./styles/docent-internship.css">
    <link rel="icon" href="./assets/favicon.ico">
</head>
<body class="home-page">
		<header class="header">
			<a href="index.php"><p class="logo"><img src="./assets/logo.png" alt=""></p></a>
			<input type="checkbox" id="click">
			<label for="click" class="menu-btn">
				<i class="fas fa-bars"></i>
			</label>
		
			<ul class="nav__links">
				
				<li><a href="#">CURSISTEN</a></li>
				<li><a href="admin-docenten.php" >DOCENTEN</a></li>
				<li><a href="#">COURSES</a></li>
			</ul>
		
			<a class="cta" href="#"><button>LOGOUT ➜</button></a>
		</header>
        <div class="navdivider"></div>
        <div class="content">
      
        <br>
        <br>
        <!--    ////////////////////////////////
                        ENTER CONTENT HERE
                ////////////////////////////////-->
				<div class="search-container">
        <input type="text" class="search-input" placeholder="search...">
        <button type="button" class="search-button"><img src="./assets/search.png" style="width: 12px"></button>
</div>
<br>
<div class="filters">

<select name="postcode" id="postcode">
<option value="blank">Postcode</option>
  <option value="3600">3600</option>
  <option value="1000">1000</option>
</select>
</div>
  <!--    ////////////////////////////////
                       		TABLE
                ////////////////////////////////-->
<div class="centerdivtable">
				<table class="styled-table">
    <thead>
        <tr>
            <th>Cursist</th>
            <th>Stageplaats</th>
            <th>Postcode</th>
            <th>Punten</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Eren Ozyurek</td>
            <td>Syntra PXL</td>
            <td>3600</td>
            <td>.../100</td>
            <td> <input type="checkbox" name="" id=""></td>
        </tr>
        <tr class="active-row">
            <td>Mark Zuck</td>
            <td>Facebook</td>
            <td>1000</td>
            <td>.../100</td>
            <td> <input type="checkbox" name="" id=""></td>
        </tr>
        <!-- and so on... -->
    </tbody>
</table>
</div>
<div class="centerdivtable">
<button type="button" class="push-button">PUSH</button>
<button type="button" class="add-button">+</button>
<button type="button" class="edit-button">EDIT</button>
</div>
        </div>
		<footer class="footer">
        <div class="footer-container">
            <div class="footer-text-left">
                KBC: BE83 4517 6050 7115 (KREDBEBB) - BTW BE 0409.773.728   
            </div>
            
            <div class="footer-content-right">
                <a href="#"> Algemene voorwaarden</a>
                <a href="#">Privacy policy</a>
                <a href="#">Cookies</a>
                <a href="#">Disclaimer</a>
            </div>
            <div class="copyright">
                &copy; 2002-2024 SyntraPXL Designed by //thrives
            </div>
        </div>
    </footer>
	</body>
</html>