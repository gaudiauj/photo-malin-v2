<nav>
    <ul class="pagination">
        <?php
        if ($nombrepage > 1) {
            $i = 1;
            if ($page == $nombrepage) {
                echo("<li><a href='comment-list-page-" . ($page - 1) . "'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>");
            }
            while ($i <= $nombrepage) {
                if($i==$page)
                {
                     echo("<li class='active'><a href='comment-list-page-" . $i . "'>" . $i . " </a></li>");
                }
                else
                {
                    echo("<li><a href='comment-list-page-" . $i . "'>" . $i . " </a></li>");
                }
                $i++;
            }
            if ($page < $nombrepage) {
                echo("<li><a href='comment-list-page-" . ($page + 1) . "'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>");
            }
        }
        ?>
    </ul>
</nav>
