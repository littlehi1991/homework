
<div style="text-align: center;">
    <label>每頁共<?php echo count($val) ;?>筆</label>
</div>
<div aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="<?php echo DOMAIN . "homework/view/member.php?page=".(($cur_page -1===0) ? 1 :$cur_page-1); ?>" >上一頁</a>
        </li>
        <?php
        for($i=1 ; $i<=$totol_page ; $i++) {
        ?>
        <li class="page-item"><a class="page-link" href="<?php echo DOMAIN ."homework/view/member.php?page=".$i;?>"><?php echo $i;?></a></li>
        <?php }?>
        <li class="page-item">
            <a class="page-link" href="<?php echo DOMAIN . "homework/view/member.php?page=".(($cur_page < $totol_page ) ? $cur_page+1 : $totol_page ) ;?>">下一頁</a>
        </li>
    </ul>
</div>

