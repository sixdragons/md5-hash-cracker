	<div class="mainArea">
		<div class="container">
			<div class="mainTitle">
				<h2>just add a password list file...</h2>
			</div>
			<div>
				<?php if($this->session->flashdata('file_added')): ?>
	              <?php echo '<p style="color:green;">'.$this->session->flashdata('file_added').'</p>'; ?>
	            <?php endif; ?>
	            <?php if($this->session->flashdata('wrong')): ?>
	              <?php echo '<p style="color:red;">'.$this->session->flashdata('wrong').'</p>'; ?>
	            <?php endif; ?>
			</div>
			<div class="formDiv">
				<?php echo validation_errors(); ?>
				
				<?php $fattr = array('class' => 'form' ); echo form_open_multipart('admin',$fattr); ?> 
					<input class="fileInput" type="file" name="password">
					<input class="fileInput" type="text" name="passwordF" placeholder="name">
					<input class="fileSubmit" type="submit" name="fileSub">
				</form>

			</div>
		</div>
	</div>