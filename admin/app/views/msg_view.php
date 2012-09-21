<?php 

$type = isset($msg_type)?$msg_type:$this->session->flashdata('msg_type');
$value = isset($msg_value)?$msg_value:$this->session->flashdata('msg_value');

if($value) : ?>

<div id="<?=$type?>" class="<?=$type?>" onclick="$(this).fadeOut(250)">
  	<?=$value?>
</div>
    
<script type="text/javascript">
	$("#<?=$type?>").css({ top: -$('#<?=$type?>').outerHeight(),
		left:($(window).width() - $('#<?=$type?>').outerWidth())/2 })
		.animate({ top: "-2px" }, 250 );
</script>
    
<?php endif; ?>