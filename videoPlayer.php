<h3 id="typeVid" style="display: inline"><?php echo $_GET['type'];?>:</h3><h3 style="display: inline"> <?php echo $_GET['vid'];?></h3>
<video id="myVid" ontimeupdate="readVid()" onended="vidEnded()" controls>
    <source src="video/<?php echo $_GET['vid'];?>" type="video/ogg">
</video>
