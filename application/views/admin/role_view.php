<div class="span10">  
    <div class="page-header">
        <h1>List of Roles</h1>
    </div>
    <script>
    $(function() {
        $('#modalConfirm').modal({
            keyboard: true,
            backdrop: true,
            show: false
        });
        
        var role_id;
        
        $('.del').click(function() {
            role_id = $(this).attr('id').replace("role_id_", "");
            $('#modalConfirm').modal('show');
            return false;
        });
        
        $('#btn-delete').click(function() {
            window.location = '<?php echo site_url('admin/role_delete'); ?>/'+role_id;
        });
    })
    </script>
    <div class="modal hide" id="modalConfirm">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Delete Role</h3>
        </div>
        <div class="modal-body">
        <p style="text-align: center;">Are you sure want to delete this role ?</p>
        </div>
        <div class="modal-footer" style="text-align: center;">
            <a href="#" class="btn" data-dismiss="modal">Cancel</a>
            <a href="#" class="btn btn-primary" id="btn-delete">Delete</a>
        </div>
    </div>
    <?php if (isset($tmp_success_del)): ?>
    <div class="alert alert-info">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        <h4 class="alert-heading">Role deleted!</h4>
    </div>
    <?php endif; ?>
    <style>table td {padding-top:7px !important; padding-bottom: 7px !important;} </style>
    <div class="span2">
        <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>&darr; Perms | Act &rarr;</td></tr>
			<tr><td><b>Admin Access</b></td></tr>
            <tr><td><b>Thread</b></td></tr>
            <tr><td>&mdash; create</td></tr>
            <tr><td>&mdash; edit</td></tr>
            <tr><td>&mdash; delete</td></tr>
            <tr><td><b>Post</b></td></tr>
            <tr><td>&mdash; create</td></tr>
            <tr><td>&mdash; edit</td></tr>
            <tr><td>&mdash; delete</td></tr>
            <tr><td><b>Role</b></td></tr>
            <tr><td>&mdash; create</td></tr>
            <tr><td>&mdash; edit</td></tr>
            <tr><td>&mdash; delete</td></tr>
        </tbody>
        </table>
    </div>
    
    <div class="span8">
        <style>#tbl-1 th, #tbl-1 td { text-align: center !important; }</style>
        <table id="tbl-1" class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <?php foreach ($roles as $role): ?>
                <th width="<?php echo $column_width; ?>%"><?php echo $role['role']; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
             <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <a title="edit" href="<?php echo site_url('admin/role_edit').'/'.$role['id']; ?>"><img src="<?php echo base_url(); ?>resources/icons/pencil.png"/></a> 
                    &nbsp;&nbsp;
                    <a title="delete" class="del" id="role_id_<?php echo $role['id']; ?>" href="<?php echo site_url('admin/role_delete').'/'.$role['id']; ?>"><img src="<?php echo base_url(); ?>resources/icons/delete.png"/></a> 
                </td>
                <?php endforeach; ?>
            </tr>
			<tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['admin_area'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>&nbsp;</td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['thread_create'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['thread_edit'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['thread_delete'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>&nbsp;</td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['post_create'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['post_edit'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['post_delete'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>&nbsp;</td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['role_create'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['role_edit'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($roles as $role): ?>
                <td>
                    <?php if ( $role['role_delete'] == 1 ): ?>
                    <img src="<?php echo base_url(); ?>resources/icons/accept.png"/>
                    <?php else: ?>
                    <img src="<?php echo base_url(); ?>resources/icons/stop.png"/>
                    <?php endif; ?>
                </td>
                <?php endforeach; ?>
            </tr>
        </tbody>
        </table>
    </div>
</div>