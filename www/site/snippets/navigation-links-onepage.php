<?php
    if(isset($linkConfig)){
      foreach ($linkConfig as $config) {
         echo '<li class="nav-item">
                 <a class="nav-link" href="' . $config['href'] . '">'. $config['title'] . '</a>
               </li>';
      }
    } else {
        echo 'nolink';
    }