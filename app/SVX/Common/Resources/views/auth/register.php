<?=$this->extend('master')?>

<?=$this->block('title', 'Register')?>

<?=$this->block('body')?>
	<div class="row">
		<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
			<?=$form->start()?>
				<h3>Register</h3>
				<hr/>

				<?=$this->formRow($form, 'username')?>
				<?=$this->formRow($form, 'email')?>

				<div class="form-group">
					<label for="<?=$form->get('unique_id')->getName()?>"><?=$this->formLabel($form, 'unique_id')?></label>
					<div class="input-group">
						<?=$form->get('unique_id')->render()?>
						<span class="input-group-addon"><a href="#">?</a></span>
					</div>
				</div>

				<?=$this->formRow($form, 'password')?>
				<?=$this->formRow($form, 'confirm_password')?>

				<div class="row">
					<div class="col-sm-12">
						<div class="btn-group pull-right">
							<input type="reset" class="btn btn-warning"/>
							<button type="submit" class="btn btn-success">Register</button>
						</div>
					</div>
				</div>
			<?=$form->end()?>
		</div>
	</div>
<?=$this->endBlock()?>