<?php if($this->session->flashdata('error') || isset($error)) : ?>
    <div class="msg error" onclick="$(this).fadeOut(250)">
    	<?=$this->session->flashdata('error')?>
    	<?=isset($error)?$error:''?>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('info') || isset($info)) : ?>
    <div class="msg info" onclick="$(this).fadeOut(250)">
    	<?=$this->session->flashdata('info')?>
    	<?=isset($info)?$info:''?>
    </div>
<?php endif; ?>