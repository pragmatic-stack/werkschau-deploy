<?php

function vimeoEmbedFromLink(?string $vimeoUrl)
{
    if($vimeoUrl == null) return null;

    $videoIDPosition = strrpos($vimeoUrl, '/');

    if (isset($videoIDPosition)) {
        $videoID = substr($vimeoUrl, $videoIDPosition + 1);
    } else {
        return null;
    }

    // Generate the code for a vimeo embedding
    if (isset($videoID)) {
        return "
            <div class='video'>
                <iframe src='https://player.vimeo.com/video/" . $videoID . "'
                        frameborder='0'
                        allow='autoplay; fullscreen'
                        allowfullscreen>
                </iframe>
            </div>
            <script src='https://player.vimeo.com/api/player.js'></script>
            ";
    } else {
        return null;
    }
}