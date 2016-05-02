<?=$this->extend('master')?>
<?=$this->block('body')?>
	<?=$form->start()?>
		<div class="form-group">
			<label for="<?=$form->get('username')->getId()?>" class="col-sm-3 control-label">Username</label>
			<div class="col-sm-9">
				<?=$form->get('username')->render()?>
			</div>
		</div>

		<div class="form-group">
			<label for="<?=$form->get('password')->getId()?>" class="col-sm-3 control-label">Password</label>
			<div class="col-sm-9">
				<?=$form->get('password')->render()?>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="btn-group pull-right">
					<input type="reset" class="btn btn-default"/>
					<button type="submit" class="btn btn-success">Login</button>
				</div>
			</div>
		</div>
	<?=$form->end()?>
<?=$this->endBlock()?>