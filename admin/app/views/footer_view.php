
	</div> <!-- body -->

	<p class="footer">footer
	<!-- langargs($this->lang->line('page_loaded'), $this->benchmark->elapsed_time())?> -->
	</p>
	
</div> <!-- container -->

<?php 

if($this->message->get_message()) : ?>

<script type="text/javascript">
	jQuery.msg('<?=$this->message->get_type()?>', '<?=$this->message->get_message()?>');
</script>
    
<?php endif; ?>

</body>
</html>