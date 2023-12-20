<?php

function scripts() : string {
    
    function script($file) :string  {
        return '<script type="application/javascript" src="js/'. $file . '.js"></script>';
    }
    
    $html = '';

    $html.= script('article/article');
    $html.= script('article/add');

    $html.= script('comments/comments');

    $html.= script('footer/footer');

    $html.= script('forms/error');
    $html.= script('forms/form');
    $html.= script('forms/popup');
    $html.= script('forms/simple');
    $html.= script('forms/yesno');
    
    $html.= script('navbar/navbar');
    
    $html.= script('page/add');
    $html.= script('page/content');
    $html.= script('page/delete');
    $html.= script('page/edit');
    $html.= script('page/rename');
    
    $html.= script('section/section');
    $html.= script('section/center');
    $html.= script('section/delete');
    $html.= script('section/down');
    $html.= script('section/hr');
    $html.= script('section/left');
    $html.= script('section/link');
    $html.= script('section/right');
    $html.= script('section/up');
    $html.= script('section/update');
    $html.= script('settings/edit');
    
    $html.= script('theme/bar');
    $html.= script('theme/title');
    $html.= script('theme/article');
    $html.= script('theme/section');
    $html.= script('theme/btn');
    $html.= script('theme/edit');
    $html.= script('theme/form');
    $html.= script('theme/gen');
    $html.= script('theme/inp');
    $html.= script('theme/nav');
    $html.= script('theme/theme');
    $html.= script('theme/delete');
    
    $html.= script('title/add');
    $html.= script('title/title');
    
    $html.= script('types/bold');
    $html.= script('types/clearformat');
    $html.= script('types/image');
    $html.= script('types/italic');
    $html.= script('types/mark');
    $html.= script('types/shadow');
    $html.= script('types/soundcloud');
    $html.= script('types/spotify');
    $html.= script('types/text');
    $html.= script('types/youtube');
    $html.= script('types/list');
    $html.= script('types/audio');
    
    $html.= script('user/account');
    $html.= script('user/edit');
    $html.= script('user/login');
    $html.= script('user/logout');
    $html.= script('user/password');

    $html.= script('tools/user');
    $html.= script('tools/admin');
    
    $html.= script('utils/conv');
    $html.= script('utils/cookies');
    $html.= script('utils/editor');
    $html.= script('utils/elements');
    $html.= script('utils/global');
    $html.= script('utils/images');
    $html.= script('utils/key');
    $html.= script('utils/server');
    $html.= script('utils/strings');
    $html.= script('utils/style');
    $html.= script('utils/text');
    $html.= script('utils/upload');
    
    $html.= '<script type="application/javascript" src="/index.js"></script>';
    
    return $html;
    
}

?>