<div class="row-fluid">
    <ul class="breadcrumb">
    <?php if ($type == 'category'): ?>
    <li>
        <a href="<?php echo site_url('thread'); ?>">Home</a>
        <span class="divider">/</span>
    </li>
    <?php $cat_total = count($cat); foreach ($cat as $key => $c): ?>
    <li>        
        <a href="<?php echo site_url('thread/category/'.$c['slug']); ?>"><?php echo $c['name']; ?></a> 
        <?php if ($key+1 != $cat_total): ?>
        <span class="divider">/</span>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
    <?php else: ?>
    <li>
        <a href="<?php echo site_url('thread'); ?>">Home</a>
    </li>
    <?php endif; ?>
    </ul>
    <?php
    function time_ago($date) {

        if(empty($date)) {
            return "No date provided";
        }

        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");
        $now = time();
        $unix_date = strtotime($date);

        // check validity of date

        if(empty($unix_date)) {
            return "Bad date";
        }

        // is it future date or past date
        if($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = "ago";
        } else {
            $difference = $unix_date - $now;
            $tense = "from now";
        }
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] {$tense}";
    }
    ?>

    <style>table td, table th {padding:10px 7px !important;} .cat {font-weight:bold;font-size: 10px;color: #333;font-style: italic;}</style>
    <div class="row-fluid">
    <div class="span3">
        <ul class="nav nav-tabs nav-stacked">
            <li class="active">
            <a href="javascript://"><b>Categories</b></a>
            </li>
            <?php foreach($categories as $cat): ?>
            <li><a href="<?php echo site_url('thread/category/'.$cat['slug']); ?>"><?php echo $cat['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="span9">
        <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th width="85%">All Threads</th>
                <th width="15%">Last Updates</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($threads as $thread): ?>
            <tr>
            <td style="font-size:12px;">
                <a style="font-family: verdana;" href="<?php echo site_url('thread/talk/'.$thread->slug); ?>"><?php echo $thread->title; ?></a>
                <span style="display: block">
                    <a href="<?php echo site_url('thread/category/'.$thread->category_slug); ?>" class="cat">Category: <?php echo $thread->category_name; ?></a>
                </span>
            </td>
            <td style="font-size:12px;color:#999;vertical-align: middle;">
                <!-- <?php echo date("m/d/y g:i A", strtotime($thread->date_add)); ?> -->
                <?php echo time_ago($thread->date_add); ?>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <div class="pagination" style="text-align:center;">
            <ul><?php echo $page; ?></ul>
        </div>
    </div>   
     </div>   
    
    
<div>