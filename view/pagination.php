<?php if(!empty($pagination)){ ?>
<div aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="<?php echo DOMAIN . "homework/view/member.php?page=".(($pagination['cur_page'] -1===0) ? 1 :$pagination['cur_page']-1); ?>" >上一頁</a>
        </li>
        <?php
        for($i=1 ; $i<=$pagination['total_page'] ; $i++) {
        ?>
        <li class="page-item"><a class="page-link" href="<?php echo DOMAIN ."homework/view/member.php?page=".$i;?>"><?php echo $i;?></a></li>
        <?php }?>
        <li class="page-item">
            <a class="page-link" href="<?php echo DOMAIN . "homework/view/member.php?page=".(($pagination['cur_page'] < $pagination['total_page'] ) ? $pagination['cur_page']+1 : $pagination['total_page'] ) ;?>">下一頁</a>
        </li>
    </ul>
</div>
<?php } ?>

