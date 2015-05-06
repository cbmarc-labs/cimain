		</div>
	</div>
</div> <!-- container -->

<!-- langargs($this->lang->line('page_loaded'), $this->benchmark->elapsed_time())?> -->

<footer class="footer text-center">
	<p>@ <?php echo $this->config->item( 'title' ); ?> v1.0.0 2015</p>
</footer>

<?php if( $alert = get_alert() ) : ?>

<script type="text/javascript">
	$(document).ready(function() {
		$.appAlert("<?php echo $alert['type']; ?>", "<?php echo $alert['message']; ?>");
	});
</script>

<?php endif; ?>

</body>
</html>