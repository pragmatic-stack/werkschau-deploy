<?php
function getWidthClass(string $widthIdent){
    switch ($widthIdent){
        case 'half':
            return 'col-md-6';
        case 'third':
            return 'col-md-4';
        case 'quarter':
            return 'col-md-3';
        case 'full':
            return 'col-md-12';
    }
}