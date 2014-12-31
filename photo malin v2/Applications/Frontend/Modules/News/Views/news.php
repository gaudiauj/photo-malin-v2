<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

foreach ($listeNews as $news)
{
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="news">
                <h2><a href="news-<?php echo $news['id']; ?>"><?php echo $news['titre']; ?></a></h2>
                <p><?php echo nl2br($news['contenu']); ?></p>
            </div>
        </div>
    </div>

    <?php
}
