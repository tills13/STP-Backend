<?=$this->extend('master')?>

<?=$this->block('body')?>
    <div class="page-header">
        <h2>Search</h2>
    </div>
    <form method="POST" class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="query">Search Query</label>
                <input id="query" name="query" placeholder="Search" class="form-control" value="<?=$query?>"/> 
            </div>
            <div class="clearfix">
                <div class="btn-group pull-right">
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 well">
            <h4 class="alt">Advanced</h4>
            <p>There are no advanced search options at the moment.</p>
        </div>
    </form>
<?=$this->endBlock()?>