<?php

if(isset($category)) {
	if($category->errors) {
		foreach( $category->errors as $error) 
			echo $error;
	}

	}    
?>
<h2>Explore our shop</h2>
<p>Here is a category based listing of some <strong>pretty awesome</strong> stuff.</p>
</header>
</div>

<div class ="imgside">
<div class="img">
  <a target="_blank" href="coins_currency">
    <img src="../images/coins.jpg" alt="Coins" width="200" height="200">
  </a>
  <div class="desc">Coins and currency </div>
</div>

<div class="img">
  <a target="_blank" href="collectibles">
    <img src="../images/collectibles.jpg" alt="Collectibles" width="200" height="200">  </a>
 <div class="desc">Collectibles </div>
 </div>


 <div class="img">
  <a target="_blank" href="art">
    <img src="../images/art.jpg" alt="Art" width="200" height="200">  </a>
 <div class="desc">Art </div>
 </div>

 <div id="clearfloat"  class ="imgside">
<div class="img">
  <a target="_blank" href="arms_armor">
    <img  src="../images/armor.jpg" alt="Arms and armors" width="200" height="200">
  </a>
  <div class="desc">Arms and armors</div>
</div>
 <div class="img">
  <a target="_blank" href="rare_books">
    <img src="../images/books.jpg" alt="Art" width="200" height="200">  </a>
 <div class="desc">Rare Books </div>
 </div>
  <div class="img">
  <a target="_blank" href="musical_instruments">
    <img src="../images/music.jpg" alt="music" width="200" height="200">  </a>
 <div class="desc">Music </div>
 </div>