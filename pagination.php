<div class="pagination" style="padding: 15px; margin-left: 45%">
<?php
                //         if ($current_page > 1 && $total_page > 1){
                //     echo '<button style = "height:30px;width:30px; background-color:white; color:black;"><a  href= "product.php?page='.($current_page-1).'"><i class="fa fa-chevron-left"></i></a></button>';
                // }

                for ($i = 1; $i <= $total_page; $i++){

                    if ($i == $current_page){
                        echo '<button style = "margin-left:10px; height:30px;width:30px; background-color:#ff523b; color:#fff;font-weight: bolder;"><span >'.$i.'</span></button>';
                    }
                    else{
                        echo '<button style = "margin-left:10px;height:30px;width:30px; background-color:white; color:black; font-weight: bolder;"><a href = "product.php?page='.$i.'">'.$i.'</a></button>';
                    }
                }

                // if ($current_page < $total_page && $total_page > 1){
                //     echo '<button style = "height:30px;width:30px; background-color:white; color:black;font-weight: bolder;"><a href="product.php?page='.($current_page+1).'"><i class="fa fa-chevron-right"></i></a></button>';
                // }

                ?> 
</div>