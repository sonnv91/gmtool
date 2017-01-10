<aside class="main-sidebar">

    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <?php foreach($menu as $m){ ?>
                <li class="<?php echo (count($m->sub_menu) > 0) ? 'treeview' : '';?><?php echo ($m->controller_name == $active_menu) ? ' active' : '';?>">
                    <a href="<?php echo base_url();?><?php echo (count($m->sub_menu) > 0) ? "#" : $m->controller_routes."/".$m->single_func;?>">
                        <i class="fa <?php echo $m->icon;?>"></i>
                        <span><?php echo $m->group_name; ?></span>
                        <?php echo (count($m->sub_menu) > 0) ? '<i class="fa fa-angle-left pull-right"></i>' : '';?>
                    </a>
                    <?php if(count($m->sub_menu) > 0){ ?>
                        <ul class="treeview-menu">
                            <?php foreach($m->sub_menu as $sub){ ?>
                                <li>
                                    <a href="<?php echo base_url();?><?php echo $m->controller_routes;?>/<?php echo $sub->func_routes;?>"><i class="fa fa-circle-o"></i><?php echo $sub->name;?></a>
                                </li>
                            <?php }?>
                        </ul>
                    <?php }?>
                </li>
            <?php } ?>
            <?php if(isAdministrator()){?>
            <li class="header">MODULE</li>
            <li>
                <a href="#">Phân quyền</a>
            </li>
            <?php }?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>