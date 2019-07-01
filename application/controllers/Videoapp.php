<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Videoapp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('globalmodel');
    }
    
    public function check_mobile(){
        $post=$this->input->post();
        if($post){
            $exist=$this->globalmodel->select_single('user_register',array('mobile_no'=>$post['mobile_no']));
            if($exist){
                echo json_encode(array('status'=>'0','message'=>'Mobile No. already exist.')); 
            }
        }else{
           echo json_encode(array('status'=>'0','message'=>'Invalid Request'));  
        }
    }
    
    public function test(){
        $this->load->view('form');
    }
    
    public function register(){
        $post=$this->input->post();
        if($post){
            $exist=$this->globalmodel->select_single('user_register',array('mobile_no'=>$post['mobile_no']));
            if($exist){
                echo json_encode(array('status'=>'0','message'=>'Mobile No. already exist.')); 
            }
            $userpost['first_name']=$post['first_name'];
            $userpost['last_name']=$post['last_name'];
            $userpost['mobile_no']=$post['mobile_no'];
            $userpost['country']=$post['country'];
            $userpost['city']=$post['city'];
            $userpost['area']=$post['area'];
            $userpost['dob']=$post['dob'];
            $userpost['gender']=$post['gender'];
            $userpost['latitude']=$post['latitude'];
            $userpost['longitude']=$post['longitude'];
            $userpost['email']=$post['email'];
            $userpost['password']=$post['password'];
            $userpost['favoured']=$post['favoured'];
            $userpost['device_token']=$post['device_token'];
            $userpost['brand_list']=$post['brand_list'];
            $userpost['survey_qa']=$post['survey_qa'];
            $userpost['status']='1';

            $userpost['moon_id']=time();
           $add= $this->globalmodel->add('user_register',$userpost);
           if($add){
               $row=$this->globalmodel->select_single('user_register',array('id'=>$add));
               $brands = $this->globalmodel->select_all('brands');
               $blist=array();
               foreach($brands as $brand){
                   $brand['brand_logo']=base_url().'/uploads/images/'.$brand['brand_logo'];
                   $blist[]=$brand;
               }
              echo json_encode(array('status'=>'1','message'=>'Thank you for resgistered with us, Your account created successfully.','userdetail'=>$row)); 
           }else{
               echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
           }
            
        }else{
         echo json_encode(array('status'=>'0','message'=>'Invalid Request')); 
    }
    }
    
    public function otp(){
        $mob=$this->input->post('mobile_no');
         $typ=$this->input->post('type');
         if($typ=='1'){
             $exist=$this->globalmodel->select_single('user_register',array('mobile_no'=>$mob));
            if($exist){
                echo json_encode(array('status'=>'0','message'=>'Mobile No. already exist.')); 
                exit;
            }
         }
         require_once(APPPATH.'libraries/textlocal.class.php');
        require_once(APPPATH.'libraries/credential.php');
        if($mob){
        $textlocal = new Textlocal(false, false, API_KEY_APP);

                $numbers = array($mob); 
                $sender = 'imoonn';
               
                $otp=substr(str_shuffle("0123456789"), 0,4);

                $message = "Your Verification Code is : ".$otp;
                $result1 = $textlocal->sendSms($numbers, $message, $sender);
                    if($result1){
                        echo json_encode(array('status'=>'1','message'=>'OTP sent successfully.','otp'=>$otp));
           }else{
            echo json_encode(array('status'=>'0','message'=>'Please try again.'));   
           }
        }else{
         echo json_encode(array('status'=>'0','message'=>'Invalid Request')); 
    }
    }
    
    public function login(){
        $post=$this->input->post();
        if($post){
        $userid=$this->input->post('user_id');
        $pass=$this->input->post('password');
        $device_token=$this->input->post('device_token');
        $row=$this->globalmodel->query("Select * from user_register where (mobile_no='$userid' OR moon_id='$userid') AND password='$pass'");
        if($row){
            echo json_encode(array('status'=>'1','message'=>'Login Success','userdetail'=>$row));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid User Id or Password.')); 
        }
        }else{
           echo json_encode(array('status'=>'0','message'=>'Invalid Request'));  
        }
    }
    
    public function videos_list(){
        $post=$this->input->post();
        $perpage=$post['per_page'];
        $page=$post['page'];
        if($page || $page=='1'){
            $offset=0;
        }else{
            $offset=$page-1;
        }
        if($perpage){
            $limit=10;
        }else{
            $limit=$perpage;
        }
        $offset=$offset*$limit;
        $total_rows=$this->globalmodel->count_rows('videos',array());
        $data = $this->globalmodel->select_limit('videos',array(),$limit,$offset);
        $vdata=array();
        $r=0;
        foreach($data as $row){
            $vrdata=array();
            $vrdata['id']=$row['id'];
            $vrdata['video_url']=base_url().'/uploads/videos/'.$row['video_file'];
            //$vrdata['cover_url']=base_url().'/uploads/images/'.$row['cover'];
            $vrdata['likes']=$this->globalmodel->count_rows('likes',array('video_id'=>$row['id']));
            $vrdata['is_like']=$this->globalmodel->count_rows('likes',array('video_id'=>$row['id'],'user_id'=>$post['user_id']));
            $vrdata['shares']=$this->globalmodel->count_rows('shares',array('video_id'=>$row['id'],'user_id'=>$post['user_id'],'status'=>'1'));
            $susers=$this->globalmodel->select_all('shares',array('video_id'=>$row['id']));
            $usrlist=array();
            foreach($susers as $ruser){
                $ndata=array();
               $udata = $this->globalmodel->select_single('user_register',array('id'=>'17'));  
               $ndata['id']=$udata['id'];
               $ndata['moon_id']=$udata['moon_id'];
               $usrlist[]=$ndata;
            }
            $vrdata['shares_list']=$usrlist;
            $vrdata['views']=$this->globalmodel->count_rows('views',array('video_id'=>$row['id']));
            //$vrdata['sponsor_name']=$row['sponsor_name'];
            //$vrdata['sponsor_status']=$row['sponsor_status'];
            //$vrdata['sponsor_app_link']=$row['sponsor_app_link'];
            //$vrdata['sponsor_product_link']=$row['sponsor_product_link'];
            //$vrdata['sponsor_msg']=$row['sponsor_msg'];
            $vrdata['remark']=$row['remark'];
            $vrdata['status']=$row['status'];
            $wtch=$this->globalmodel->count_rows('watched',array('user_id'=>$post['user_id'],'video_id'=>$row['id']));
            if($wtch){
            $vrdata['iswatched']=true;
            }else{
                $vrdata['iswatched']=false;
            }
            $vdata[]=$vrdata;
            $r++;
        }
        if($vdata){
            echo json_encode(array('status'=>'1','total_records'=>$total_rows,'data'=>$vdata));
        }else{
            echo json_encode(array('status'=>'0','message'=>'No Result found')); 
        }
    }
    
    public function video_like_unlike(){
        $post=$this->input->post();
        
            $exist=$this->globalmodel->count_rows('likes',array('video_id'=>$post['video_id'],'user_id'=>$post['user_id']));
           if($exist){
              $res= $this->globalmodel->delete('likes',array('video_id'=>$post['video_id'],'user_id'=>$post['user_id']));
              $msg="Video Unliked Successfully.";
           } else{
              $res= $this->globalmodel->add('likes',array('video_id'=>$post['video_id'],'user_id'=>$post['user_id']));
              $msg="Video Liked Successfully.";
           }
        if($res){
            echo json_encode(array('status'=>'1','message'=>$msg));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
    }
    
    public function video_share(){
        $post=$this->input->post();
        
            $exist=$this->globalmodel->count_rows('shares',array('video_id'=>$post['video_id'],'user_id'=>$post['user_id']));
           if(!$exist){
             
              $res= $this->globalmodel->add('shares',array('video_id'=>$post['video_id'],'user_id'=>$post['user_id']));
              if($res){
            echo json_encode(array('status'=>'1','message'=>'Video Shared Successfully.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
           }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
    }
    
    public function video_viewed(){
        $post=$this->input->post();
        
            $exist=$this->globalmodel->count_rows('shares',array('video_id'=>$post['video_id'],'user_id'=>$post['user_id']));
           if(!$exist){
             $res= $this->globalmodel->add('views',array('video_id'=>$post['video_id'],'user_id'=>$post['user_id']));
              $res2= $this->globalmodel->update('shares',array('video_id'=>$post['video_id'],'share_to'=>$post['user_id']),array('status'=>'1'));
              if($res && $res2){
            echo json_encode(array('status'=>'1','message'=>'Video Viewed.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
           }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
    }
    
    public function hashtag_invite(){
        $post=$this->input->post();
          $res= $this->globalmodel->add('hashtag_invites',array('ad_id'=>$post['Ad_id'],'sender_id'=>$post['sender_id'],'receiver_id'=>$post['receiver_id']));
              if($res){
            echo json_encode(array('status'=>'1','message'=>'Invite Request Submitted.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
         
    }
    
    public function invite_list(){
        $userid=$this->input->post('user_id');
        $udata = $this->globalmodel->select_single('user_register',array('id'=>$userid));
        if($udata){
        $send = $this->globalmodel->select_all('hashtag_invites',array('sender_id'=>$udata['moon_id']));
        $rec = $this->globalmodel->select_all('hashtag_invites',array('receiver_id'=>$udata['moon_id']));
        $sdata=array();
        $rdata=array();
        foreach($send as $row){
            $rid=$row['receiver_id'];
            $videoid=$row['ad_id'];
            
          $urdata=$this->globalmodel->select_single('user_register',array('moon_id'=>$rid));
          if($rid && $videoid && $urdata){
          $vdata=$this->globalmodel->select_single('videos',array('id'=>$videoid));
          if($vdata){
            $vdata['video_url']=base_url().'/uploads/videos/'.$vdata['video_file'];
            $vdata['cover_url']=base_url().'/uploads/images/'.$vdata['cover'];
            $vdata['sponsor_name']=$vdata['sponsor_name'];
            $vdata['sponsor_status']=$vdata['sponsor_status'];
            $vdata['sponsor_app_link']=$vdata['sponsor_app_link'];
            $vdata['sponsor_product_link']=$vdata['sponsor_product_link'];
            $vdata['sponsor_msg']=$vdata['sponsor_msg'];
            $wtch=$this->globalmodel->count_rows('watched',array('user_id'=>$rid,'video_id'=>$videoid));
            if($wtch){
            $vdata['iswatched']=true;
            }else{
                $vdata['iswatched']=false;
            }
          }
          unset($urdata['password']);
          $follow=$this->globalmodel->select_single('followers',array('follower_id'=>$userid,'user_id'=>$urdata['id']));
          if($follow){
              $urdata['isfollow']=true;
          }else{
              $urdata['isfollow']=false;
          }
          $urdata['total_follower']=$this->globalmodel->count_rows('followers',array('user_id'=>$urdata['id']));
          $urdata['total_following']=$this->globalmodel->count_rows('followers',array('follower_id'=>$urdata['id']));
          $row['userdetails']=$urdata;
          $row['videodetail']=$vdata;
            $sdata[]=$row;
            }
        }
        
        foreach($rec as $row){
            $rid=$row['sender_id'];
            $videoid=$row['ad_id'];
            
          $urdata=$this->globalmodel->select_single('user_register',array('moon_id'=>$rid));
          if($rid && $videoid && $urdata){
          $vdata=$this->globalmodel->select_single('videos',array('id'=>$videoid));
          if($vdata){
            $vdata['video_url']=base_url().'/uploads/videos/'.$vdata['video_file'];
            $vdata['cover_url']=base_url().'/uploads/images/'.$vdata['cover'];
            $vdata['sponsor_name']=$vdata['sponsor_name'];
            $vdata['sponsor_status']=$vdata['sponsor_status'];
            $vdata['sponsor_app_link']=$vdata['sponsor_app_link'];
            $vdata['sponsor_product_link']=$vdata['sponsor_product_link'];
            $vdata['sponsor_msg']=$vdata['sponsor_msg'];
             $wtch=$this->globalmodel->count_rows('watched',array('user_id'=>$rid,'video_id'=>$videoid));
            if($wtch){
            $vdata['iswatched']=true;
            }else{
                $vdata['iswatched']=false;
            }
          }
          unset($urdata['password']);
          $follow=$this->globalmodel->select_single('followers',array('follower_id'=>$userid,'user_id'=>$urdata['id']));
          if($follow){
              $urdata['isfollow']=true;
          }else{
              $urdata['isfollow']=false;
          }
           $urdata['total_follower']=$this->globalmodel->count_rows('followers',array('user_id'=>$urdata['id']));
          $urdata['total_following']=$this->globalmodel->count_rows('followers',array('follower_id'=>$urdata['id']));
           $row['userdetails']=$urdata;
           $row['videodetail']=$vdata;
            $rdata[]=$row;
            }
        }
              echo json_encode(array('status'=>'1','message'=>'','send'=>$sdata,'Received'=>$rdata)); 
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function invite_status_update(){
        $adid=$this->input->post('invite_id');
        $status=$this->input->post('status');
        if($status && $adid){
         $res2= $this->globalmodel->update('hashtag_invites',array('id'=>$adid),array('status'=>$status));
            if($res2){
            echo json_encode(array('status'=>'1','message'=>'Invite Status Submitted.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function brand_list(){
        $brands = $this->globalmodel->select_all('brands');
               $blist=array();
               foreach($brands as $brand){
                   $brand['question']=explode('|',$brand['question']);
                   $brand['brand_logo']=base_url().'/uploads/images/'.$brand['brand_logo'];
                   $brand['video_ad_url']=base_url().'/uploads/videos/'.$brand['video_ad_url'];
                   $brand['thumb_url']=base_url().'/uploads/images/'.$brand['thumb_url'];
                   $blist[]=$brand;
               }
              echo json_encode(array('status'=>'1','message'=>'','data'=>$blist)); 
    }
    
    public function brand_detail(){
        $post=$this->input->post();
        if($post){
        $brand = $this->globalmodel->select_single('brands',array('id'=>$post['brand_id']));
          $brand['question']=explode('|',$brand['question']);
          $brand['brand_logo']=base_url().'/uploads/images/'.$brand['brand_logo'];
          $brand['video_ad_url']=base_url().'/uploads/videos/'.$brand['video_ad_url'];
          $brand['thumb_url']=base_url().'/uploads/images/'.$brand['thumb_url'];
        if($brand){
           echo json_encode(array('status'=>'1','message'=>'','data'=>$brand)); 
        }else{
            echo json_encode(array('status'=>'0','message'=>'No Result Found.')); 
        }
        }else{
           echo json_encode(array('status'=>'0','message'=>'Invalid Request'));  
        }
        
    }
    
    public function selected_brands(){
        $userid=$this->input->post('user_id');
        if($userid){
        $udata = $this->globalmodel->select_single('user_register',array('id'=>$userid));
        if($udata['brand_list']){
        $brands=explode(",",$udata['brand_list']);
               $blist=array();
               foreach($brands as $brandid){
                   $brand=$this->globalmodel->select_single('brands',array('id'=>$brandid));
                   $brand['question']=explode('|',$brand['question']);
                   $brand['brand_logo']=base_url().'/uploads/images/'.$brand['brand_logo'];
                   $brand['video_ad_url']=base_url().'/uploads/videos/'.$brand['video_ad_url'];
                   $brand['thumb_url']=base_url().'/uploads/images/'.$brand['thumb_url'];
                   $blist[]=$brand;
               }
              echo json_encode(array('status'=>'1','message'=>'','data'=>$blist));
        }else{
           echo json_encode(array('status'=>'1','message'=>'','data'=>array())); 
        }
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request')); 
        }
    }
    
    public function available_brands(){
        $userid=$this->input->post('user_id');
        if($userid){
            $udata = $this->globalmodel->select_single('user_register',array('id'=>$userid));
            $sbrands=explode(",",$udata['brand_list']);
        $brands = $this->globalmodel->select_all('brands');
               $blist=array();
               foreach($brands as $brand){
                   if(in_array($brand['id'],$sbrands)){
                       $brand['status']='1';
                   }else{
                       $brand['status']='0';
                   }
                   $brand['question']=explode('|',$brand['question']);
                   $brand['brand_logo']=base_url().'/uploads/images/'.$brand['brand_logo'];
                   $brand['video_ad_url']=base_url().'/uploads/videos/'.$brand['video_ad_url'];
                   $brand['thumb_url']=base_url().'/uploads/images/'.$brand['thumb_url'];
                   $blist[]=$brand;
               }
              echo json_encode(array('status'=>'1','message'=>'','data'=>$blist)); 
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request')); 
        }
    }
    
    public function update_brand_list(){
        $userid=$this->input->post('user_id');
        $list=$this->input->post('brand_list');
        if($userid){
         $res2= $this->globalmodel->update('user_register',array('id'=>$userid),array('brand_list'=>$list));
            if($res2){
            echo json_encode(array('status'=>'1','message'=>'Brand List updated successfully.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function update_follower(){
        $post=$this->input->post();
        if($post){
            if($post['type']=='follow'){
          $res= $this->globalmodel->add('followers',array('user_id'=>$post['follower_id'],'follower_id'=>$post['user_id']));
            }else{
          $res= $this->globalmodel->delete('followers',array('user_id'=>$post['follower_id'],'follower_id'=>$post['user_id']));
                
            }
              if($res){
            echo json_encode(array('status'=>'1','message'=>'Request Completed.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function video_watched(){
        $post=$this->input->post();
        if($post){
          $res= $this->globalmodel->add('watched',array('user_id'=>$post['user_id'],'video_id'=>$post['video_id']));

              if($res){
            echo json_encode(array('status'=>'1','message'=>'Request Completed.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    
    public function get_history(){
        $userid=$this->input->post('user_id');
       if($userid){
              $udata = $this->globalmodel->select_single('user_register',array('id'=>$userid));
           $bids=explode(',',$udata['brand_list']);
           $bdata=array();
           foreach($bids as $bid){
               $brand=$this->globalmodel->select_single('brands',array('id'=>$bid));
           $bdata['brand_names'][]=$brand['brand_name'];
               
           }
           
           $downloads=$this->globalmodel->select_all('vdownloads',array('user_id'=>$userid));
           foreach($downloads as $download){
              $vdata=$this->globalmodel->select_single('videos',array('id'=>$download['video_id']));
           $download['video_url']=base_url().'/uploads/videos/'.$vdata['video_file'];
            $download['cover_url']=base_url().'/uploads/images/'.$vdata['cover'];
            $download['sponsor_name']=$vdata['sponsor_name'];
            $download['sponsor_status']=$vdata['sponsor_status'];
            $download['sponsor_app_link']=$vdata['sponsor_app_link'];
            $download['sponsor_product_link']=$vdata['sponsor_product_link'];
            $download['sponsor_msg']=$vdata['sponsor_msg']; 
            $bdata['downloads'][]=$download;
           }
           
           $views=$this->globalmodel->select_all('watched',array('user_id'=>$userid));
           foreach($views as $download){
              $vdata=$this->globalmodel->select_single('videos',array('id'=>$download['video_id']));
           $download['video_url']=base_url().'/uploads/videos/'.$vdata['video_file'];
            $download['cover_url']=base_url().'/uploads/images/'.$vdata['cover'];
            $download['sponsor_name']=$vdata['sponsor_name'];
            $download['sponsor_status']=$vdata['sponsor_status'];
            $download['sponsor_app_link']=$vdata['sponsor_app_link'];
            $download['sponsor_product_link']=$vdata['sponsor_product_link'];
            $download['sponsor_msg']=$vdata['sponsor_msg']; 
            $bdata['watched_videos'][]=$download;
           }
           
          echo json_encode(array('status'=>'1','message'=>'','data'=>$udata));
       }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    
    public function downloaded_app(){
        $post=$this->input->post();
        if($post){
            $exist=$this->globalmodel->select_single('vdownloads',array('user_id'=>$post['user_id'],'video_id'=>$post['video_id']));
            if($exist){
          $res= $this->globalmodel->update('vdownloads',array('id'=>$exist['id']),array('app_name'=>$post['app_name']));
                
            }else{
          $res= $this->globalmodel->add('vdownloads',array('user_id'=>$post['user_id'],'video_id'=>$post['video_id'],'app_name'=>$post['app_name']));
            }
              if($res){
            echo json_encode(array('status'=>'1','message'=>'Request Completed.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function follower_list(){
        $post=$this->input->post();
        if($post){
        $data = $this->globalmodel->select_all('followers',array('user_id'=>$post['user_id']));
               $blist=array();
               foreach($data as $row){
                   $userid=$row['follower_id'];
                  $udata = $this->globalmodel->select_single('user_register',array('id'=>$userid));
                  unset($udata['password']);
                  $blist[]=$udata;
               }
              echo json_encode(array('status'=>'1','message'=>'','data'=>$blist)); 
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function following_list(){
        $post=$this->input->post();
        if($post){
        $data = $this->globalmodel->select_all('followers',array('follower_id'=>$post['user_id']));
               $blist=array();
               foreach($data as $row){
                   $userid=$row['user_id'];
                  $udata = $this->globalmodel->select_single('user_register',array('id'=>$userid));
                  unset($udata['password']);
                  $blist[]=$udata;
               }
              echo json_encode(array('status'=>'1','message'=>'','data'=>$blist)); 
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function get_follower(){
        $post=$this->input->post();
        if($post){
            $urdata=array();
            $udata = $this->globalmodel->select_single('user_register',array('id'=>$post['follower_id']));
          
         $follow=$this->globalmodel->select_single('followers',array('follower_id'=>$post['user_id'],'user_id'=>$post['follower_id']));
          if($follow){
              $udata['isfollow']=true;
          }else{
              $udata['isfollow']=false;
          }
           $udata['total_follower']=$this->globalmodel->count_rows('followers',array('user_id'=>$post['follower_id']));
          $udata['total_following']=$this->globalmodel->count_rows('followers',array('follower_id'=>$post['follower_id']));
          
                  unset($udata['password']);
                  $urdata['userdetail']=$udata;
              echo json_encode(array('status'=>'1','message'=>'','data'=>$udata)); 
        }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function get_user_profile(){
       $userid=$this->input->post('user_id'); 
       if($userid){
           
          
              $udata = $this->globalmodel->select_single('user_register',array('id'=>$userid));
              unset($udata['password']);
           $udata['total_follower']=$this->globalmodel->count_rows('followers',array('user_id'=>$userid));
          $udata['total_following']=$this->globalmodel->count_rows('followers',array('follower_id'=>$userid));
          $bdata = $this->globalmodel->select_single('bank_details',array('user_id'=>$userid));
          if($bdata){
              $udata['bank_status']='1';
          }else{
              $udata['bank_status']='0';
          }
          echo json_encode(array('status'=>'1','message'=>'','data'=>$udata));
       }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function update_setting(){
        $post=$this->input->post(); 
        $type=$this->input->post('type'); 
       if($type){
          if($type=='Password'){
              $udata = $this->globalmodel->select_single('user_register',array('id'=>$post['user_id']));
              if($udata){
                  if($udata['password']==$post['old_password']){
                      $this->globalmodel->update('user_register',array('id'=>$post['user_id']),array('password'=>$post['new_password']));
                      echo json_encode(array('status'=>'1','message'=>'Password Updated successfully.')); 
                  }else{
                      echo json_encode(array('status'=>'0','message'=>'Invalid Password.')); 
                  }
              }else{
                  echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
              }
          }
          
          if($type=='Username'){
              $udata = $this->globalmodel->select_single('user_register',array('id'=>$post['user_id']));
              if($udata){
                      $this->globalmodel->update('user_register',array('id'=>$post['user_id']),array('first_name'=>$post['first_name'],'last_name'=>$post['last_name']));
                      echo json_encode(array('status'=>'1','message'=>'User Name Updated successfully.')); 
                 
              }else{
                  echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
              }
          }
          
          if($type=='Mobile'){
              $udata = $this->globalmodel->select_single('user_register',array('id'=>$post['user_id']));
              if($udata){
                      $this->globalmodel->update('user_register',array('id'=>$post['user_id']),array('mobile_no'=>$post['mobile_no']));
                      echo json_encode(array('status'=>'1','message'=>'Mobile No. Updated successfully.')); 
                  
              }else{
                  echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
              }
          }
       }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function all_urls(){
        $data['terms_conditions']="http://www.google.com";
        $data['privacy_policy']="http://www.google.com";
        $data['about']="http://www.google.com";
        $data['faq']="http://www.google.com";
        echo json_encode(array('status'=>'1','message'=>'','data'=>$data));
    }
    
    public function add_bank_details(){
        $post=$this->input->post();
          $res= $this->globalmodel->add('bank_details',array('user_id'=>$post['user_id'],'bank_name'=>$post['bank_name'],'account_no'=>$post['account_no'],'ifsc'=>$post['ifsc'],'branch'=>$post['branch'],'beneficiary_name'=>$post['beneficiary_name'],'account_type'=>$post['account_type']));
              if($res){
            echo json_encode(array('status'=>'1','message'=>'Bank details added.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
         
    }
    
    public function update_bank_details(){
        $post=$this->input->post();
          $res= $this->globalmodel->update('bank_details',array('user_id'=>$post['user_id']),array('bank_name'=>$post['bank_name'],'account_no'=>$post['account_no'],'ifsc'=>$post['ifsc'],'branch'=>$post['branch'],'beneficiary_name'=>$post['beneficiary_name'],'account_type'=>$post['account_type']));
              if($res){
            echo json_encode(array('status'=>'1','message'=>'Bank details updated.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
         
    }
    
    public function delete_bank_details(){
        $post=$this->input->post();
          $res= $this->globalmodel->delete('bank_details',array('user_id'=>$post['user_id']));
              if($res){
            echo json_encode(array('status'=>'1','message'=>'Bank details deleted.'));
        }else{
            echo json_encode(array('status'=>'0','message'=>'Something went wrong, Please try again.')); 
        }
         
    }
    
    public function get_bank_details(){
       $userid=$this->input->post('user_id'); 
       if($userid){
           
          
              $udata = $this->globalmodel->select_single('bank_details',array('user_id'=>$userid));
             if($udata){
          echo json_encode(array('status'=>'1','message'=>'','data'=>$udata));
             }else{
                 echo json_encode(array('status'=>'0','message'=>'Bank Details Not Found.')); 
             }
       }else{
            echo json_encode(array('status'=>'0','message'=>'Invalid Request.')); 
        }
    }
    
    public function otp2(){
        require_once(APPPATH.'libraries/textlocal.class.php');
       require_once(APPPATH.'libraries/credential.php');
        $textlocal = new Textlocal(false, false, API_KEY_APP);

                $numbers = array('9478001005'); 
                $sender = 'imoonn';
               
                $otp=substr(str_shuffle("0123456789"), 0,4);

                $message = "Your Verification Code is : ".$otp;
               
                $result = $textlocal->sendSms($numbers, $message, $sender);
                print_r($result);
    }
    
    private function send_txt($numbers,$message){
        $username = "manu@i3moon.com";
	$hash = "c6f6d8fd998c194afb87caa2225aff4d833bf2a0304f8833c8472181c6688f07";
	$test = "0";
	$sender = "imoonn"; // This is who the message appears to be from.
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	print_r($result);
	curl_close($ch);
    }
    
    
}