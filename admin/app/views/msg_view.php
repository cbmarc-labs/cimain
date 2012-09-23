<?php 

$type = isset($msg_type)?$msg_type:$this->session->flashdata('msg_type');
$value = isset($msg_value)?$msg_value:$this->session->flashdata('msg_value');

if($value) : ?>

<script type="text/javascript">
jQuery.msg('<?=$type?>', '<?=$value?>');
</script>
    
<?php endif; ?>