<?=$this->extend('master')?>

<?=$this->block('title', 'Cache Management')?>

<?=$this->block('body')?>
    <h3>Admin Cache Dashboard</h3>
    <table class="table">
        <tr>
            <td>APCu Version</td>
            <td><?=phpversion('apcu')?></td>
        </tr>
        <tr>
            <td>PHP Version</td>
            <td><?=phpversion()?></td>
        </tr>
        <tr>
            <td>APCu Host</td>
            <td><?=$_SERVER['SERVER_NAME']?></td>
        </tr>
        <tr>
            <td>Server Software</td>
            <td><?=$_SERVER['SERVER_SOFTWARE']?></td>
        </tr>
        <tr>
            <td>Shared Memory</td>
            <td><?=$mem['num_seg']?> Segment(s)</td>
        </tr>
        <tr>
            <td colspan="2"><?=$segmentSize ?? 0?></td>
        </tr>
        <tr>
            <td>Start Time</td>
            <td><?=date('M d Y h:m:s', $cache['start_time'])?></td>
        </tr>
        <tr>
            <td>Since</td>
            <td><?php //$utils::ago($cache['start_time']) ?></td>
        </tr>
        <tr>
            <td>File Upload Support</td>
            <td><?=$cache['file_upload_progress'] ?? 0?></td>
        </tr>
    </table>

    <h3>Stats</h3>
    <?=$this->progressBar([
        'segments' => [
            [
                'progress' => floatval($loadAverages['15']) * 100,
                'label' => "{$loadAverages['15']}% CPU load (avg)",
                'color' => $loadAverages['15'] > 0.5 ? '#C33327' : '#4DA43D'
            ]
        ]
    ])?>

    <?=$this->progressBar([
        'segments' => [
            [
                'progress' => $disk['utilization'],
                'label' => "{$disk['utilization']}% disk utilization",
                'color' => $disk['utilization'] > 50 ? '#C33327' : '#4DA43D'
            ]
        ]
    ])?>

    <h3>Cached Items</h3>
    <table class="table table-striped">
        <?php foreach($cache['cache_list'] as $key => $item) { ?>
            <tr data-key="<?=$item['info']?>">
			    <td data-sortable-key="<?=$item['info']?>">
                    <a class="u" href="javascript:;" data-entity-id="<?=$item['info']?>"><?=$item['info']?></a>
                </td>
			    <td data-sortable-key="<?=$item['num_hits']?>">
                    <?=$item['num_hits']?>
                </td>
			    <td class="responsive" data-sortable-key="<?=$item['ttl']?>">
                    <?=$item['ttl']?>
                </td>
			    <td class="responsive" data-sortable-key="<?=$item['creation_time']?>">
                    <?=$utility::ago($item['creation_time'])?>
                </td>
			    <td class="responsive" data-sortable-key="<?=$item['access_time']?>">
                    <?=$utility::ago($item['access_time'])?>
                </td>
			    <td data-sortable-key="<?=$item['mem_size']?>">
                    <?=$utility::niceBytes($item['mem_size'])?>
                </td>
			    <td>
                    <a href="javascript:;" class="fa fa-times" onclick="admin.invalidateCache(this)"></a>
                </td>
		    </tr>
        <?php } ?>
    </table>
<?=$this->endBlock()?>

<?=$this->block('javascript')?>
    <script src="<?=$router->generateUrl('javascript', ['filename' => 'admin.js'])?>"></script>
<?=$this->endBlock()?>