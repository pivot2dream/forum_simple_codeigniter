<div class="span10">  
    <div class="page-header">
        <h1>Edit Category</h1>
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
            <h4 class="alert-heading">Category updated!</h4>
        </div>
        <?php endif; ?>
        <fieldset>
          <input type="hidden" name="row[id]" value="<?php echo $category->id; ?>"/>
          <input type="hidden" name="row[name_c]" value="<?php echo $category->name; ?>"/>
          <input type="hidden" name="row[slug_c]" value="<?php echo $category->slug; ?>"/>
          <div class="control-group">
            <label class="control-label" for="input01">Name</label>
            <div class="controls">
              <input type="text" class="input-xlarge" value="<?php echo $category->name; ?>" name="row[name]" id="input01">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input01">Slug</label>
            <div class="controls">
              <input type="text" class="input-xlarge" value="<?php echo $category->slug; ?>" name="row[slug]" id="input01">
              <p class="help-block">for url friendly address</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="select01">Parent</label>
            <div class="controls">
              <select id="select01" name="row[parent_id]">
                <option <?php if ($category->id == 0): ?>selected="selected"<?php endif; ?> value="0">-- none --</option>  
                <?php foreach ($categories as $cat): ?>
                <?php if ($category->id != $cat['id']): ?>
                <option <?php if ($category->parent_id == $cat['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                <?php else: ?>
                <option disabled style="background:#d3d3d3;" value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          
          <div class="form-actions">
            <input type="submit" name="btn-edit" class="btn btn-primary" value="Save"/>
          </div>
        </fieldset>
      </form>
          
</div>