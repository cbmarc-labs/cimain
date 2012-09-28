
</div> <!-- container -->

<!-- langargs($this->lang->line('page_loaded'), $this->benchmark->elapsed_time())?> -->

<?php if(logged_in()):?>
<footer class="footer">
</footer>

<div id="message" class="alert alert-<?=$type?> <?=$type?>-icon hide">
&nbsp;&nbsp;&nbsp;<?=$message?>
</div>

<?php if($message) :?>
	<script type="text/javascript">
	<!--
	$("#message")
		.css({'cursor':'pointer','position':'absolute','padding-left':'30px'})
		.centerWidth()
		.animate({top:"-2px"},250)
		.click(function(){
			$(this).fadeOut(250,function(){
				$(this).remove();
			})
		})
		.show();
	-->
	</script>
<?php endif; ?>

<?php endif ?>

</body>
</html>