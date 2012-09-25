
</div> <!-- container -->

<!-- langargs($this->lang->line('page_loaded'), $this->benchmark->elapsed_time())?> -->

<?php if(logged_in()):?>
<footer class="footer">
</footer>

<?php if($this->message->get_message()) : ?>

<script type="text/javascript">
	jQuery.msg('<?=$this->message->get_type()?>', '<?=$this->message->get_message()?>');
</script>

<?php endif ?>

<?php endif ?>

</body>
</html>