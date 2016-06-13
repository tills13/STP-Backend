<?=$this->extend('master')?>

<?=$this->block('title', 'Login')?>

<?=$this->block('body')?>
	<div class="row">
		<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
			<?=$form->start()?>
				<h3>Login</h3>
				<hr/>
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
							<input type="reset" class="btn btn-warning"/>
							<button type="submit" class="btn btn-success">Login</button>
						</div>
					</div>
				</div>
			<?=$form->end()?>
		</div>
	</div>
<?=$this->endBlock()?>