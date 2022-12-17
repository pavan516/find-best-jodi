<?php

namespace App\Controllers\Ajax;

use App\Controllers\Controller;
use Illuminate\Pagination\Paginator;



/**
* Controlling AJAX
*/
class AjaxController extends Controller
{

    public function get_day_name($timestamp) {

        $date = date('d M, Y', $timestamp);
        $time = date('h.i a', $timestamp);
        if($date == date('d M, Y')) {
          $date = 'Today ';
        } 
        else if($date == date('d M, Y',time() - (24 * 60 * 60))) {
          $date = 'Yesterday ';
        }
        return $date . " " . $time;
    }
    public function fetchUser($request, $response)
    {
        $user = $this->user->find($request->getParam('user_id'));
        $status = $user->user_feeling;
        if ($user->status == "Write Any Status") {
            $status = "Hey there, I am using our media.";
        }
        $user_array = [
            'user_id' => $user->user_id,
            'user_name' => ucfirst($user->user_name),
            'user_image' => "/user_images/" . $user->user_image,
            'last_login' => $this->get_day_name(strtotime($user->last_login)),
            'status' => $status
        ];
        echo json_encode($user_array);
        die();

    }
    public function createImageMessage($request, $response)
    {
        $user_id = trim($request->getParam('user_id'));

        $message = (trim($request->getParam('message')));
        $recipient = $this->user->find($user_id);

        if (!$recipient) {
            die('Not a valid recipient');
        }
        if (!$message) {
            die('Empty Message');
        }

        $user_email = $_SESSION['user_email'];
        $sender = $this->user->where('user_email', $user_email)->first();
        // Check for blockness...
        $block = $this->checkBlockage($sender->user_id, $recipient->user_id);
        if ($block) {
            echo json_encode(['type' => 'error' , 'message' => $block, 'user_id1' => $sender->user_id, 'user_id2' => $recipient->user_id]);
            die();
        }
        // Check if the user is eligible to even start the chat
        $follow = $this->checkFollow($recipient->user_id);
        if (!$follow) {
            echo json_encode(['type' => 'error' , 'message' => "You need to be a follower of the user to start chat.", 'otherend_id' => $recipient->user_id ]);
            die();
        }
        $convExist = false;

        // Check if there is already a conversation exist between the two
        foreach ($sender->conversations as $conversation) {
            $cPivot = $this->conversationpivot->where('conversation_id', $conversation->id)->where('user_id', $recipient->user_id)->first();
            if ($cPivot) {
                // There is already a conversation exist between recipient and sender
                $convExist = $conversation->id;
                break;
            }
        }

        if ($convExist) {
            $conversation = $this->conversation->find($convExist);
        } else {
            $conversation = $sender->conversations()->create([]);          
            $this->conversationpivot->create(['conversation_id' => $conversation->id, 'user_id' => $recipient->user_id]);     
        }
        $conversation->updated_at = time();
        $conversation->save();
        $message = $conversation->messages()->create([
                'sender_id' => $sender->user_id,
                'type' => 'image', 
                'content' => $message,
                 'created_at' => date("y-m-d h:i:s",time())
            ]);
        $message->sent = true;
        $message->save();
        if ($message) {
            echo json_encode([
                    'message' => $message->content,
                    'type' => 'image',
                    'sender_name' => $sender->user_name,
                    'sender_id' => $sender->user_id,
                    'conversation_id' => $conversation->id,
                    'sent_at' => date("d-m-y h.i", strtotime($message->created_at)),
                    'sent' => true,
                    'already' => $convExist,



                ]);  
            die();
        } else {
            die("unsent");
        }
    }
    public function viewProfile($request, $response, $username)
    {
        die("redirecting you to the profile");
    }
    protected function checkBlockage($blocker_id, $attainer_id)
    {
        $myBlock = $this->blockuser->where('blocker_id', $blocker_id)->where('attainer_id', $attainer_id)->count();
        $otherBlock = $this->blockuser->where('attainer_id', $blocker_id)->where('blocker_id', $attainer_id)->count();
        $block = false;
        if ($myBlock) {
            $block =  "You blocked this user to have chat";
        } elseif ($otherBlock) {
            $block =  "You have been blocked by this to user to have chat";
        }
        return $block;
        
    }
    public function ping($request, $response)
    {

        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        if (!$me) {
            die();
        }
        // Retain Online
        $this->iamOnline($me);
        $data = [];
        // Render New Messages..
        $unreadConvo = 0;
        foreach ($me->conversations as $conversation ) {
            $count = $conversation->messages->sortByDesc('created_at')->count();
            $content = "No Message";
            if ($count > 0 ) {
                $type = $conversation->messages->sortByDesc('created_at')->first()->type;
                $content = $conversation->messages->sortByDesc('created_at')->first()->content;
                if ($type == "image") {
                    $content = "Image";
                }
            }
            if ($conversation->messages->where('sender_id', '!=',$me->user_id)->where('seen', false)->count()) {
                $unreadConvo = $unreadConvo + 1;
            } 
            $data[] = [
                'conversation_id' => $conversation->id,
                'unread' => $conversation->messages->where('sender_id', '!=',$me->user_id)->where('seen', false)->count() ,
                'last_message' => substr(strip_tags($content), 0,30) . "...",
                'username' => date("d-m-y h.i", strtotime($conversation->users()->where('users.user_id', '!=',$me->user_id)->first()->user_name)) ,
                'online' => $conversation->users()->where('users.user_id', '!=',$me->user_id)->first()->online,
            ];
        }
        // Adding More Data
        echo json_encode(array_merge(['convoData' => $data], ['unreadConvo' => $unreadConvo ]));


    }
    public function pong($request, $response)
    {
        // If the last seen is less than 5 minutes, make him offline
        $allusers = $this->user->all();
        foreach ($allusers as $user) {
            // echo abs(time() - strtotime($user->last_login));
            // echo "<br>";
            if (abs(time() - strtotime($user->last_login)) > (2 * 60)) {
                $user->online = false;
                $user->save();
            }
            // echo ($user->user_name);
            // echo "<br>";
            // echo ($user->online);
            // echo "<br>";
        }


    }
    public function checkFollow($otherend_id)
    {
        $user_email = $_SESSION['user_email'];
        $sender = $this->user->where('user_email', $user_email)->first();
        
        
        $noOfFollowers = ($sender->followers()->count());
        $noOfFollowings = ($sender->followings()->count());
        $inFollowers = false;
        $inFollowing = false;
        if ($noOfFollowers) {
            $followed_entries = $sender->followers()->get();
            // Follower Loop
            // echo "<br> FOLLOWERS <br>";
            // 
           
            foreach ($followed_entries as $followed_entry) {
                $followers_user = $followed_entry->follower()->first();
                // var_dump($followers_user->user_name);
                if ($followers_user->user_id == $otherend_id) {
                    $inFollowers = true;
                }
              
            }
            // echo "<br>  <br>";
        }
        if ($noOfFollowings) {
            $followings = $sender->followings()->get();
            // echo "<br> FOLLOWING <br>";
            // Following Loop
            foreach ($followings as $following_entry) {
                $following_user = $following_entry->following()->first();
                // var_dump($following_user->user_name);
                if ($following_user->user_id == $otherend_id) {
                    $inFollowing = true;
                }
              
            }
        }
        if ($inFollowing) {
            return true;
        }
        if ($inFollowers) {
            return true;
        }
        return false;

        
    

    }
    public function createMessage($request, $response)
    {
        $user_id = trim($request->getParam('user_id'));
        $message = (trim($request->getParam('message')));
        // parsing message for tag
       

        preg_match_all('/@[a-z0-9]+/i',  $message, $tags );
        $tags = $tags[0];
        $validtag = false;
        $string = "";

        foreach ($tags as $tag) {
            if ($string == "") {
                $string = $message;
            }
            $tag = substr($tag, 1);
            $replacement = "@".$tag;
            if ($user = $this->user->where('user_name', $tag)->first()) {
                $validtag = true;
                $replacement = '<a target="_blank" href="/user_profile.php?user=' .  base64_encode($user->user_id) .'">@' . $tag. '</a>';
            }
            $string = (preg_replace('/@'.$tag.'+/i',  $replacement , $string));
        }
        
        if ($validtag) {
             $message = $string;
         } else {
            $message = htmlspecialchars($message);
         }
        
        $recipient = $this->user->find($user_id);

        if (!$recipient) {
            die('Not a valid recipient');
        }
        if (!$message) {
            die('Empty Message');
        }
        $user_email = $_SESSION['user_email'];
        $sender = $this->user->where('user_email', $user_email)->first();

        // Check for blockness...
        $block = $this->checkBlockage($sender->user_id, $recipient->user_id);
        if ($block == "You blocked this user to have chat" ) {
            $attainer_id = $recipient->user_id;
        }
        if ($block) {
            echo json_encode(['type' => 'error' , 'message' => $block, 'attainer_id' => $attainer_id ]);
            die();
        }
        // Check if the user is eligible to even start the chat
        $follow = $this->checkFollow($recipient->user_id);
        if (!$follow) {
            echo json_encode(['type' => 'error' , 'message' => "You need to be a follower of the user to start chat.", 'otherend_id' => $recipient->user_id ]);
            die();
        }

        $convExist = false;

        // Check if there is already a conversation exist between the two
        foreach ($sender->conversations as $conversation) {
            $cPivot = $this->conversationpivot->where('conversation_id', $conversation->id)->where('user_id', $recipient->user_id)->first();
            if ($cPivot) {
                // There is already a conversation exist between recipient and sender
                $convExist = $conversation->id;
                break;
            }
        }

        if ($convExist) {
            $conversation = $this->conversation->find($convExist);
        } else {
            $conversation = $sender->conversations()->create([]);          
            $this->conversationpivot->create(['conversation_id' => $conversation->id, 'user_id' => $recipient->user_id]);     
        }
        $conversation->updated_at = time();
        $conversation->save();
        $message = $conversation->messages()->create([
                'sender_id' => $sender->user_id,
                'type' => 'text', 
                'content' => $message,
                 'created_at' => date("y-m-d h:i:s",time())
            ]);
        $message->sent = true;
        $message->save();
        if ($message) {
            echo json_encode([
                    'message' => $message->content,
                    'type' => 'text',
                    'sender_name' => $sender->user_name,
                    'sender_id' => $sender->user_id,
                    'conversation_id' => $conversation->id,
                    'sent_at' => date("d-m-y h.i", strtotime($message->created_at)),
                    'sent' => true,
                    'already' => $convExist,



                ]);  
            die();
        } else {
            die("unsent");
        }
    }
    public function getLastMessage($request, $response)
    {
        $user_email = $_SESSION['user_email'];
        $sender = $this->user->where('user_email', $user_email)->first();
        $converation = $sender->conversations->find($request->getParam('conversation_id'));
        echo json_encode($conversation);
    }
    public function getLastMessages($request, $response, $count)
    {
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        $conversation = $me->conversations->find($request->getParam('conversation_id'));
        $messages = $conversation->messages()->orderBy('created_at','desc')->simplePaginate($count);
        $data = [];

        foreach ($messages as $message) {
            $sender = $this->user->find($message->sender_id);
            $mine = false;
            if ($me->user_id === $message->sender_id) {
                $mine = true;
            }
            $data[] = [
                'sender_id' => $message->sender_id,
                'sender_name' => ucfirst($sender->user_name),
                'sender_pic' => "/user_images/" . $sender->user_image,
                'me' => $mine,
                'type' => $message->type,
                'content' => $message->content,
                'sent' => $message->sent,
                'seen' => (bool) $message->seen,
                'seen_at' => date("d-m-y h.i", strtotime($message->seen_at)),
                'created_at' => date("d-m-y h.i", strtotime($message->created_at)),


            ];
        }
        echo json_encode($data);
    }
    public function getConversationIDfromUserID($request, $response)
    {

        $user_email = $_SESSION['user_email'];
        $sender = $this->user->where('user_email', $user_email)->first();

        $convExist = false;

        // Check if there is already a conversation exist between the two
        foreach ($sender->conversations as $conversation) {
            $cPivot = $this->conversationpivot->where('conversation_id', $conversation->id)->where('user_id', $request->getParam('user_id'))->first();
            if ($cPivot) {
                // There is already a conversation exist between recipient and sender
                $convExist = $conversation->id;
                break;
            }
        }
        echo  $convExist;
    }
    public function seenConversation($request, $response)
    {
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        $conversation = $me->conversations->find($request->getParam('conversation_id'));
        // Making All Messages from sender _d

        foreach ($conversation->messages->where('sender_id', '!=',$me->user_id)->where('seen', false)->all() as $message) {
                $message->seen = true;
                $message->seen_at = date("y-m-d h:i:s",time());
                $message->save();
        }
        die("seen");
    }
    public function getBatchUpdate($request, $response)
    {
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        $data = [];
        // Check if the there is a need to update current conversation
        


        foreach ($me->conversations as $conversation ) {
            $count = $conversation->messages->sortByDesc('created_at')->count();
            $content = "No Message";
            if ($count > 0 ) {
                $type = $conversation->messages->sortByDesc('created_at')->first()->type;
                $content = $conversation->messages->sortByDesc('created_at')->first()->content;
                if ($type == "image") {
                    $content = "Image";
                }
            }
            
        
            $data[] = [
                'conversation_id' => $conversation->id,
                'unread' => $conversation->messages->where('sender_id', '!=',$me->user_id)->where('seen', false)->count() ,
                'last_message' => substr(strip_tags($content), 0,30) . "...",
                'last_seen' =>  $this->get_day_name(strtotime($conversation->users()->where('users.user_id', '!=',$me->user_id)->first()->last_login)) ,
                'online' => $conversation->users()->where('users.user_id', '!=',$me->user_id)->first()->online,

            ];
        }

        echo json_encode($data);
        $this->iamOnline($me);
    }

    public function clearConversation($request, $response)
    {
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        $conversation = $me->conversations->find($request->getParam('conversation_id'));
        $messages = $conversation->messages()->delete();

    }
    public function deleteConversation($request, $response)
    {
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        $conversation = $me->conversations->find($request->getParam('conversation_id'));
        $messages = $conversation->messages()->delete();
        $this->conversationpivot->where('conversation_id', $request->getParam('conversation_id'))->delete();
        $conversation->delete();
    }
    public function block($request, $response)
    {

        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        $attainer = $this->user->find($request->getParam('user_id'));
        if (!$attainer) {
            die('Failed');
        }
        $this->blockuser->firstOrCreate([
                'blocker_id' =>  $me->user_id,
                'attainer_id' =>  $attainer->user_id,


            ]);

        die('blocked');

    }
    public function unblock($request, $response)
    {
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();


        $attainer = $this->user->find($request->getParam('user_id'));
        if (!$attainer ) {
            die('Failed');
        }
        $this->blockuser->where('attainer_id', $attainer->user_id)->where('blocker_id', $me->user_id)->delete();
        die('unblocked');
    }
    public function iamOnline($user)
    {
      
        $user->online = true;
        $user->last_login = date("Y-m-d H:i:s",time());
        $user->save();
        return date("Y-m-d h:i:s",time() + 1*60*60);
    }




    public function search($request, $response, $filter, $query)
    {
        switch ($filter) {
            case 'Members':
                $result = $this->user->where('user_name', 'LIKE' ,'%'. $query . '%')->select("user_name as queryTitle")->addSelect("user_id as slug")->addSelect("user_image as image")->get()->toArray();
                if ($result) {
                $result[0]['link'] = "/user_profile.php?user=" ;     
                $result[0]['image'] = "/user_profile_images/". $result[0]['image'] ;     
                }
                echo json_encode($result);
                die();

                break;
            case 'Posts':
                $result = $this->post->where('post_title', 'LIKE' ,'%'. $query . '%')->select("post_title as queryTitle")->addSelect("post_id as slug")->addSelect("post_image as image")->get()->toArray(); 
                if ($result) {
                $result[0]['link'] = "/Postsdetails.php?post=" ;   
                $result[0]['image'] = "/posts_images/". $result[0]['image'] ;     

                }      
                echo json_encode($result);
                die();

                break;
            case 'Events':
                $result = $this->event->where('post_title', 'LIKE' ,'%'. $query . '%')->select("post_title as queryTitle")->addSelect("post_id as slug")->addSelect("post_image as image")->get()->toArray();   
                if ($result) {
                    $result[0]['link'] = "/eventsdetails.php?post=" ; 
                    $result[0]['image'] = "/posts_images/". $result[0]['image'] ;               
            
                }
                echo json_encode($result);
                die();

                break;
            case 'Stories':
                $result = $this->news->where('post_title', 'LIKE' ,'%'. $query . '%')->select("post_title as queryTitle")->addSelect("post_id as slug")->addSelect("post_image as image")->get()->toArray();   
                if ($result) {
                $result[0]['link'] = "/details.php?post=" ;   
                $result[0]['image'] = "/posts_images/". $result[0]['image'] ;     
                }       
                echo json_encode($result);
                die();

                break;
            case 'StartUps':
                $result = $this->startup->where('post_title', 'LIKE' ,'%'. $query . '%')->select("post_title as queryTitle")->addSelect("post_id as slug")->addSelect("post_image as image")->get()->toArray();
                if ($result) {    
                $result[0]['link'] = "/startupsdetails.php?post=" ;   
                $result[0]['image'] = "/posts_images/". $result[0]['image'] ;       
                 }   
                echo json_encode($result);
                die();

                break;
            default:
                # code...
                break;
        }
    }

    public function changeCover($request, $response)
    {
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        if (!$me) {
            die("Not logged in");
        }
        $message = (trim($request->getParam('message')));
        $encodedData = str_replace(' ','+',$message);
        $encodedData =  substr($encodedData,strpos($encodedData,",")+1);
        $decodedData = base64_decode($encodedData);
        $path =  $_SERVER['DOCUMENT_ROOT'] . '\\user_cover_images\\' . $me->user_id . '.JPG';
        file_put_contents( $path ,$decodedData);
        $me->user_cimage = $me->user_id . ".JPG";
        $me->save();
        echo "sent";

    }
    public function uploadCover($request,$response)
    {
        ini_set('post_max_size', '10M');
        ini_set('upload_max_filesize', '10M');
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        if (!$me) {
            die("Not logged in");
        }
        $message = (trim($request->getParam('message')));
        $encodedData = str_replace(' ','+',$message);
        $encodedData =  substr($encodedData,strpos($encodedData,",")+1);
        $decodedData = base64_decode($encodedData);
        $int =  mt_rand(11111111, 99999999);

        $path =  $_SERVER['DOCUMENT_ROOT'] . '\\temp\\' . $int  . '.JPG';
        if ((file_put_contents( $path ,$decodedData))) {
            echo  '\\temp\\' . $int  . '.JPG';
        } else {
            echo "failed";
        }
    }


    ///////////////////////////////
    // PROVIDING FOLLOWING BY ME //
    ///////////////////////////////
    public function followingbyme()
    {
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        if (!$me) {
            die("Not logged in");
        }
        if ((!isset($_GET['start'])) or (!isset($_GET['limit']))) {
            die("No set");
        }
        $followingbyme = $this->follower->where('user_id', $me->user_id)->skip($_GET['start'])->take($_GET['limit'])->get();
        foreach ($followingbyme as $following) {
            $following = $this->user->find($following->follow_id);
            $user_id = $following->user_id;
            $encoded_user_id = base64_encode($following->user_id);
            $status = "offline";
            if ($following->online) {
                $status = "online";
            }
            echo<<<EOD
                <div class="item fetched">
                    <div class="animate-box">
                        <a href="https://findbestjodi.com/user_images/$following->user_image" class="image-popup fh5co-board-img" title="$following->user_feeling"><img src="user_images/$following->user_image" alt="$following->user_name Image Is Missing Find Later"></a>
                    </div>
                
                    <div class="fh5co-desc">
                        <a href='https://findbestjodi.com/user_profile.php?user=$encoded_user_id' style='color:#2c82f8;font-size:120%'><b>$following->user_name</b><p style='float:right;color:#4dc82c'>$status</p></a><br>
                        <label>Gender :</label> $following->user_gender<br>
                        <label>Age :</label> $following->age Years<br>
                        <label>RelationShip Status :</label> $following->user_status<br>
                        <label>Searching For A :</label> $following->user_searchingfor<br>
                        <label>Religion :</label> $following->user_religion<br>

                        <a class="btn btn-default" href="https://findbestjodi.com/user_profile.php?user=$encoded_user_id" >View Profile</a>

                        <a class="btn btn-default" href="/chat/public/?user_name=$following->user_name" >Chat with Me</a>
EOD;
                     include __DIR__ . "/../../../../follow.php";
echo<<<EOD
                    </div>

                </div>
EOD;
        }
    }


    // Providing Followers and following names
    public function names()
    {
        $user_email = $_SESSION['user_email'];
        $me = $this->user->where('user_email', $user_email)->first();
        if (!$me) {
            die("Not logged in");
        }
        $nameArray = [];
        $followingbyme = $this->follower->where('user_id', $me->user_id)->get();
        foreach ($followingbyme as $following) {
            $following = $this->user->find($following->follow_id);
            $nameArray[] = $following->user_name;
        }
        $followerbyme = $this->follower->where('follow_id', $me->user_id)->get();
        foreach ($followerbyme as $follower) {
            $follower = $this->user->find($follower->follow_id);
            $nameArray[] = $follower->user_name;
        }

        echo json_encode(array_unique($nameArray));



    }
}
    