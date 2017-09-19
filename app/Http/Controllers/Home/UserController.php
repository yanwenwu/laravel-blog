<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Controllers\Controller;
use App\Repository\UsersRepository;
use App\Service\UsersService;
use App\Repository\ArticleRepository;

class UserController extends Controller
{
    //
    protected $request ;
    protected $user;
    
    public function __construct(Request $request, UsersRepository $user)
    {
        $this->request = $request;
        $this->user    = $user;
    }
    
    public function index($id)
    {
        return view('home.user.index',[
            'articles' => $this->user->getArticles(intval($id)),
            'id'       => $id,
        ]);
    }
    
    public function share($id, ArticleRepository $article)
    {
        $total = $article->getTotalAritcle($id);
        return view('home.user.share',[
                'id' => $id,
            'pages'  => $total['pages'],
            'total'  => $total['total'],
        ]);
    }
    
    public function comment()
    {
        return view('home.user.comment');
    }
    
    public function like()
    {
        return view('home.user.like');
    }
    
    public function attend()
    {
        return view('home.user.attend');
    }
    
    public function store()
    {
        return view('home.user.store');
    }
    
    public function edit()
    {
        return view('home.user.edit');
    }
    
    public function setPassword()
    {
        return view('home.user.setPassword');
    }
    
    public function setAvatar()
    {
        return view('home.user.setAvatar');
    }
    
    public function notice(UsersRepository $users)
    {
        return view('home.user.notice',[   
            'notice' => $users->getUserNotice($this->request->user('home')->id),
        ]);
    }
    
    public function activation()
    {
        return view('home.user.activation');
    }
    
    
    public function write(UsersService $userService)
    {

        return view('home.user.write',[
            'category' => $userService->getCategory(),
        ]);
    
       
    }
    
    
    public function publish(StoreArticleRequest $request, UsersService $userService)
    {
        return $userService->publish($request) ? $this->ajaxSuccess('发布成功') : $this->ajaxError('发布失败,请检查~');
        
    }
   
}
