
</div> <!-- container -->

<!-- langargs($this->lang->line('page_loaded'), $this->benchmark->elapsed_time())?> -->

<?php if(logged_in()):?>
<footer class="footer">
</footer>

	<?php $msg = get_message(); ?>
	<?php if($msg['message']) : ?>
	
	<script type="text/javascript">
		jQuery.msg('<?=$msg['type']?>', '<?=$msg['message']?>');
	</script>
	
	<?php endif ?>

<?php endif ?>

</body>
</html>