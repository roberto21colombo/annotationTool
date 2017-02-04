<!--Firefox fires the timeupdate event once per frame. Safari 5 and Chrome 6 fire every 250ms. Opera 10.50 fires every 200ms.-->
<?php $nameGroup = model::getGroupFromId($_GET['id']); ?>
<h3 id="typeVid" style="display: inline"><?php echo $_GET['type'];?>:</h3><h3 style="display: inline"> <?php echo $_GET['vid'];?></h3>
<video id="myVid" ontimeupdate="readVid()" onended="vidEnded()" controls>
    <source src="video/<?php echo $nameGroup."/".$_GET['vid'];?>" type="video/ogg">
</video>
