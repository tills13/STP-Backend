<?=$this->extend('master')?>

<?=$this->block('title', 'Login')?>

<?=$this->block('body')?>
	<div class="row">
		<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
			<?=$form->start()?>
				<h3>Login</h3>
				<hr/>
				
				<?=$this->formRow($form, 'username')?>
				<?=$this->formRow($form, 'password')?>

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