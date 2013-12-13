<div class="span3"></div>
<div class="span6">
        <div class="page-header">
            <h3 style="text-align:center;">Create New Thread</h3>
        </div>
        <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <h4 class="alert-heading">Error!</h4>
            <?php if (isset($error['title'])): ?>
                <div>- <?php echo $error['title']; ?></div>
            <?php endif; ?>
            <?php if (isset($error['slug'])): ?>
                <div>- <?php echo $error['slug']; ?></div>
            <?php endif; ?>  
            <?php if (isset($error['category'])): ?>
                <div>- <?php echo $error['category']; ?></div>
            <?php endif; ?>  
            <?php if (isset($error['post'])): ?>
                <div>- <?php echo $error['post']; ?></div>
            <?php endif; ?>  
        </div>
        <?php endif; ?>
        <form class="well" action="" method="post" style="margin: 5px 10px;">
        <script>
        $(function() {
            $('#title').change(function() {
                var title = $('#title').val().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
                $('#slug').val(title);
            });
        });
        </script>
        <label>Title</label>
        <input type="text" id="title" name="row[title]" class="span12" placeholder="">
        <label>Slug (url friendly)</label>
        <input type="text" id="slug" name="row[slug]" class="span12" placeholder="">
        <label>Category</label>
        <select class="span12" name="row[category_id]">
            <option value="0">-- none --</option>  
            <?php foreach ($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/jquery/jwysiwyg/jquery.wysiwyg.css"/>
        <script src="<?php echo base_url(); ?>resources/jquery/jwysiwyg/jquery.wysiwyg.js" charset="utf-8"></script>
        <script src="<?php echo base_url(); ?>resources/jquery/jwysiwyg/controls/wysiwyg.link.js" charset="utf-8"></script>
        
        <script>
            controlValue = {
                    justifyLeft: { visible : false },
                    justifyCenter: { visible : false },
                    justifyRight: { visible : false },
                    justifyFull: { visible : false },
                    insertHorizontalRule: { visible: false },
                    insertTable: { visible: false },
                    insertImage: { visible: false },
                    h1: { visible: false },
                    h2: { visible: false },
                    h3: { visible: false }
                };
            cssValue = {
                    fontFamily: 'Verdana',
                    fontSize: '13px'
                };
            $(document).ready(function(){
                $('#firstpost').wysiwyg({
                    initialContent: '', html: '',
                    controls: controlValue,
                    css: cssValue,
                    autoGrow: true
                });
            });
        </script>
        <label>First Post</label>
        <textarea name="row_post[post]" id="firstpost"  rows="8" class="span12"></textarea>
        <input type="submit" style="margin-top:15px;font-weight: bold;" name="btn-create" class="btn btn-primary btn-large" value="Create Thread"/>
        </form>
    </div>
<div class="span3"></div>