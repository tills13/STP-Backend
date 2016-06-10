<?=$this->extend('master')?>
<?=$this->block('body')?>
	<?=$form->start()?>
		<div class="row">
			<div class="pull-right"></div>	
		</div>

		<div class="form-group">
			<label for="<?=$form->get('username')->getId()?>" class="col-sm-3 control-label">Username</label>
			<div class="col-sm-9">
				<?=$form->get('username')->render()?>
			</div>
		</div>

		<div class="form-group">
			<label for="<?=$form->get('email')->getId()?>" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<?=$form->get('email')->render()?>
			</div>
		</div>

		<div class="form-group">
			<label for="<?=$form->get('unique_id')->getId()?>" class="col-sm-3 control-label">Unique Id</label>
			<div class="col-sm-9">
				<div class="input-group">
				  	<?=$form->get('unique_id')->render()?>
				  	<span class="input-group-addon"><a href="#">?</a></span>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="<?=$form->get('password')->getId()?>" class="col-sm-3 control-label">Password</label>
			<div class="col-sm-9">
				<?=$form->get('password')->render()?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<?=$form->get('confirm_password')->render()?>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="btn-group pull-right">
					<input type="reset" class="btn btn-warning"/>
					<button type="submit" class="btn btn-success">Register</button>
				</div>
			</div>
		</div>
	<?=$form->end()?>
<?=$this->endBlock()?>