<script type="text/javascript">
<!--
	$(document).ready(function() {

		$("html").click(function(e) {
			$('.app-alert').hide();
		});
		
	});
//-->
</script>

<?php
if( $alert = get_alert() ):

switch( $alert['type'] ) {
	case 'success':
		$icon = "glyphicon-ok";
		break;
	case 'info':
		$icon = "glyphicon-info-sign";
		break;
	case 'warning':
		$icon = "glyphicon-warning-sign";
		break;
	default:
		$icon = "glyphicon-remove";
}
?>
<div class="container app-alert blink_me_5">
    <div class="row">
        <div class="col-xs-12 col-lg-offset-8 col-lg-4">
			<div class="alert alert-<?php echo $alert['type']; ?> clearfix" role="alert">
			
				<div class="glyphicon <?php echo $icon; ?>" style="float:left;width:9%;">&nbsp;</div>
				<div style="float:left;width:89%;"><?php echo $alert['message']; ?></div>
				
			</div>
		</div>
	</div>
</div>
<?php endif; ?>