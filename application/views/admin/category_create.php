<div class="span10">  
    <div class="page-header">
        <h1>Create New Category</h1>
    </div>
    <form class="form-horizontal" method="post" action="">
        <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <h4 class="alert-heading">Error!</h4>
            <?php if (isset($error['name'])): ?>
                <div>- <?php echo $error['name']; ?></div>
            <?php endif; ?>
            <?php if (isset($error['slug'])): ?>
                <div>- <?php echo $error['slug']; ?></div>
            <?php endif; ?>  
        </div>
        <?php endif; ?>  
        <?php if (isset($tmp_success)): ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <h4 class="alert-heading">New category added!</h4>
        </div>
        <?php endif; ?>
        <script>
        $(function() {
            $('#name').change(function() {
                var name = $('#name').val().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
                $('#slug').val(name);
            });
        });
        </script>
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="input01">Name</label>
            <div class="controls">
              <input type="text" class="input-xlarge" name="row[name]" id="name">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input01">Slug</label>
            <div class="controls">
              <input type="text" class="input-xlarge" name="row[slug]" id="slug">
              <p class="help-block">for url friendly address</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="select01">Parent</label>
            <div class="controls">
              <select id="select01" name="row[parent_id]">
                <option value="0">-- none --</option>  
                <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          
          <div class="form-actions">
            <input type="submit" name="btn-create" class="btn btn-primary" value="Create Category"/>
          </div>
        </fieldset>
      </form>
          
</div>