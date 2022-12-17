<?php


use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\RoleMiddleware;

// Home
$app->get('/', ['App\Controllers\Home\HomeController', 'index'])->setName('home');

// // Contact
$app->get('/contact', ['App\Controllers\Query\QueryController', 'getContact'])->setName('contact');
// $app->post('/contact', ['App\Controllers\Query\QueryController', 'contact'])->setName('contact.post');

// // Report a bug
$app->get('/report', ['App\Controllers\Query\QueryController', 'getReport'])->setName('report');
// $app->post('/report', ['App\Controllers\Query\QueryController', 'report'])->setName('report.post');


$app->get('/ping', ['App\Controllers\Ajax\AjaxController', 'ping'])->setName('ping');
$app->get('/pong', ['App\Controllers\Ajax\AjaxController', 'pong'])->setName('pong');


// Ajax
$app->get('/profile/{username}', ['App\Controllers\Ajax\AjaxController', 'viewProfile'])->setName('profile');

$app->get('/ajax/user/fetch', ['App\Controllers\Ajax\AjaxController', 'fetchUser'])->setName('ajax.user.fetch');
$app->get('/ajax/message/create', ['App\Controllers\Ajax\AjaxController', 'createMessage'])->setName('ajax.message.create');
$app->post('/ajax/message/create/image', ['App\Controllers\Ajax\AjaxController', 'createImageMessage'])->setName('ajax.message.create.image');
$app->get('/ajax/message/fetch/{count}', ['App\Controllers\Ajax\AjaxController', 'getLastMessages'])->setName('ajax.message.fetch');
$app->get('/ajax/service/getConvFromUser', ['App\Controllers\Ajax\AjaxController', 'getConversationIDfromUserID'])->setName('ajax.service.get.conversation_id');
$app->get('/ajax/service/seen', ['App\Controllers\Ajax\AjaxController', 'seenConversation'])->setName('ajax.service.seen');
$app->get('/ajax/service/update/whole', ['App\Controllers\Ajax\AjaxController', 'getBatchUpdate'])->setName('ajax.service.update');

$app->get('/ajax/service/conversation/clear', ['App\Controllers\Ajax\AjaxController', 'clearConversation'])->setName('ajax.service.clear');
$app->get('/ajax/service/conversation/delete', ['App\Controllers\Ajax\AjaxController', 'deleteConversation'])->setName('ajax.service.delete');
$app->get('/ajax/service/conversation/block', ['App\Controllers\Ajax\AjaxController', 'block'])->setName('ajax.service.block');
$app->get('/ajax/service/conversation/unblock', ['App\Controllers\Ajax\AjaxController', 'unblock'])->setName('ajax.service.unblock');


$app->post('/change/image/cover', ['App\Controllers\Ajax\AjaxController', 'changeCover'])->setName('ajax.change.cover');
$app->post('/change/image/upload', ['App\Controllers\Ajax\AjaxController', 'uploadCover'])->setName('ajax.change.upload');

$app->get('/getnames', ['App\Controllers\Ajax\AjaxController', 'names'])->setName('ajax.names');


// Search

$app->get('/ajax/search/{filter}/{query}', ['App\Controllers\Ajax\AjaxController', 'search'])->setName('ajax.search');

// PROVIDING FOLLOWING BY ME
$app->get('/followingbyme', ['App\Controllers\Ajax\AjaxController', 'followingbyme'])->setName('followingbyme');

