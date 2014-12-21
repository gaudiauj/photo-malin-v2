<?php if($nombrepage>1)
{
    echo("<p>Page : ");
    $i=1;
    while($i<=$nombrepage)
    {
        echo("<a href='comment-list-page-".$i."'>".$i." </a>");
        $i++;
    }
    echo("</p>");
}
