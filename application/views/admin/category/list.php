<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>CATEGORY LIST</h3>
            </div>

            <div class="title_right">
                <div class="pull-right">
                    <a href="<?php echo base_url() . 'admin/category/add'; ?>" class="btn btn-default" >Add Category</a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Category <small>List</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>                      
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <?php if ($this->session->flashdata('ErrorMessages') != '') { ?>
                            <div class="alert alert-error">
                                <button data-dismiss="alert" class="close" type="button">&times;</button>
                                <?php echo $this->session->flashdata('ErrorMessages'); ?>
                            </div><!--alert-->
                        <?php }

                        if ($this->session->flashdata('SucMessage') != '') {
                            ?>
                            <div class="alert alert-success">
                                <button data-dismiss="alert" class="close" type="button">&times;</button>
                                <?php echo $this->session->flashdata('SucMessage'); ?>
                            </div><!--alert-->
                        <?php } ?>

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Created date</th>  
                                    <th>Action</th>     
                                </tr>
                            </thead>


                            <tbody>
                                <?php foreach ($category_lists as $key => $list) { ?>
                                    <tr>
                                        <td><?php echo $list['cate_name']; ?></td>                                       
                                        <td><?php echo date("Y-m-d", strtotime($list['created_on'])); ?></td>
                                        <td >   <a href="<?php echo base_url(); ?>admin/category/edit/<?php echo md5($list['pk_cat_id']); ?>" title="edit"><i class="fa fa-edit"></i></a> 
                                            &nbsp;&nbsp;&nbsp;<a title="delete" href="<?php echo base_url(); ?>admin/category/delete/<?php echo md5($list['pk_cat_id']); ?>" onClick="return confirm('Do u really want to delete Category?');" > <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
