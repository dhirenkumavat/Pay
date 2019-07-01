<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('sms');
        $this->load->model('admin_model');
    }
 
     public function register()
    {
        $json_obj = json_decode($this->input->raw_input_stream);
        $this->output->set_header('Access-Control-Allow-Origin: *');

        if (!property_exists($json_obj,'mobile_no')) {
            $json = array(
                'Code'    => '403',
                'Message' => 'mobile number  is required',
            );
            $this->output->set_status_header('403');
            } elseif (!property_exists($json_obj, 'email')) {
           $json = array(
                 'Code'    => '403',
                 'Message' => 'Email is required',
             );
             $this->output->set_status_header('403');
             
        }else {
                $randnum = mt_rand(1111111111,9999999999);


            $data = array(
                 'moon_id'    => $randnum,
			    'first_name'   => $json_obj->first_name,
                'last_name'   => $json_obj->last_name,
                'mobile_no'   => $json_obj->mobile_no,
                'email'     => $json_obj->email,
                'password'    => $json_obj->password,
                'gender'    => $json_obj->gender,
                'age_gender'    => $json_obj->age_gender,
                'latitude'    => $json_obj->latitude,
                'longitude'    => $json_obj->longitude,
                'country'    => $json_obj->country,
                'city'    => $json_obj->city,
                'state'    => $json_obj->state,
                'status'    => '1',

               );
          
           $email=$data['email'];
            
          if($this->user_model->is_email_available($email)){  
           
             $json = array(
                    'Code'    => '402',
                    'Message' => 'Email Already register.',
                );
                
            }elseif($dat=$this->user_model->insert($data)) {
                  $id=$this->db->insert_id();
                
              $this->db->where('id',$id);
          
              $q = $this->user_model->get_data('user_register', array('id'=>$id));
	foreach($q as $sub){
	    $id=$sub->id;
	    $moon_id=$sub->moon_id;
	    $first_name=$sub->first_name;
	    $last_name=$sub->last_name;
	    $mobile_no=$sub->mobile_no;
	    $email=$sub->email;
		$password=$sub->password;
	    $gender=$sub->gender;
	    $age_gender=$sub->age_gender;
	    $latitude=$sub->latitude;
	    $longitude=$sub->longitude;
	    $country=$sub->country;
	    $city=$sub->city;
	    $state=$sub->state;
	     $status=$sub->status;

	   
	     $q2=array("id"=>$id,"moon_id"=>$moon_id,"first_name"=>$first_name,"last_name"=>$last_name,"mobile_no"=>$mobile_no,"email"=>$email,"password"=>$password,"gender"=>$gender,"age_gender"=>$age_gender,"latitude"=>$latitude,"longitude"=>$longitude,"country"=>$country,"state"=>$state,"city"=>$city,"status"=>$status);
             $json = array(
                    'Code'    => '200',
                    'Message' => 'User Registered successfully',
                    'User'    =>$q2,
                );
                $this->output->set_status_header('200');
	}
            } else {
                $json = array(
                    'Code'    => '402',
                    'Message' => 'Can\'t Registered  user, try again later.',
                );
                $this->output->set_status_header('402');
            }
           }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }
    
    
    public function login()
    {
        
        $json_obj = json_decode($this->input->raw_input_stream);
        $this->output->set_header('Access-Control-Allow-Origin: *');
        
        //require_once(APPPATH.'libraries/textlocal.class.php');
        //require_once(APPPATH.'libraries/credential.php');

         if (!property_exists($json_obj,'mobile_no')) {
            $json = array(
                'Code'    => '402',
                'Message' => 'Mobile No. is required',
            );
            $this->output->set_status_header('402');
        
        
         }elseif(!property_exists($json_obj, 'password')){
             
             
              $json = array(
                'Code'    => '402',
                'Message' => 'Password is required',
            );
            $this->output->set_status_header('402');
             
             
             
         }else{
              $data = array(
                'mobile_no'    => $json_obj->mobile_no,
                'password' => $json_obj->password,
                
                );
                
                 
                
               $mobile_no=$data['mobile_no'];
               $password=$data['password'];
            
               $cond=array('mobile_no'=>$mobile_no,'password'=>$password);
             
             if($result=$this->user_model->get_one_row('user_register',array('mobile_no'=>$mobile_no,'password'=>$password))){
                 
                  $q = $this->user_model->get_data('user_register',$cond);
                  
                 // if (count($q) > 0) 
			//{
			//	$textlocal = new Textlocal(false, false, API_KEY);

                //$numbers = array($data['mobile_no']); 
                //$sender = 'TXTLCL';
               // $otp = mt_rand(10000,99999);
               // $cond = array(
				//'mobile_no'  => $mobile_no);
	//	$data = array('otp' =>$otp);
	//	$this->user_model->update_tbl('user_register', $cond, $data);
              //  $message = "Your Verification Code is : ".$otp;
                
               // try {
               
                
                    //$result = $textlocal->sendSms($numbers, $message, $sender);
                   // setcookie('otp',$otp);
                    
                  
//redirect('otp', 'refresh');
                //} catch (Exception $e) {
                   // die('Error: ' . $e->getMessage());
                //}
               				
			//}
			//else{
			//$json = array(
                   // 'Code'    => '403',
                    //'Message' => 'Your mobile no. not register',
               // );
               // $this->output->set_status_header('403');
			//}
                  
                  
                  
                  
	foreach($q as $sub){
	    $id=$sub->id;
	    $password=$sub->password;
	    $first_name=$sub->first_name;

	    $mobile_no=$sub->mobile_no;
	    $email=$sub->email;
	    $last_name=$sub->last_name;
	    $moon_id=$sub->moon_id;
	    $gender=$sub->gender;
	    $age_gender=$sub->age_gender;
	    $latitude=$sub->latitude;
	    $longitude=$sub->longitude;
	    $country=$sub->country;
	    $city=$sub->city;
	    $state=$sub->state;
	    $status=$sub->status;
	    //$otp=$sub->otp;

	    
              $q2=array("id"=>$id,"first_name"=>$first_name,"mobile_no"=>$mobile_no,"email"=>$email,"password"=>$password,"last_name"=>$last_name,"moon_id"=>$moon_id,"gender"=>$gender,"age_gender"=>$age_gender,"longitude"=>$longitude,"latitude"=>$latitude,"country"=>$country,"state"=>$state,"city"=>$city,"status"=>$status);
                  $json = array(
                    'Code'    => '200',
                    'Message' => 'User login successfully',
                    'User'    =>$q2,
                );
                $this->output->set_status_header('200');
                 }
               }else{
                    $json = array(
                    'Code'    => '403',
                    'Message' => 'You have entered wrong Mobile No. & password.',
                );
                $this->output->set_status_header('403');
                 
             }
             
               
                
       }
        
         $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }
    
    
    
     public function otp()
          { 
      $json_obj = json_decode($this->input->raw_input_stream);
        $this->output->set_header('Access-Control-Allow-Origin: *'); 
        
         require_once(APPPATH.'libraries/textlocal.class.php');
        require_once(APPPATH.'libraries/credential.php');
        
             if (!property_exists($json_obj, 'mobile_no')) {
            $json = array(
                'Code'    => '402',
                'Message' => 'Mobile No. is required',
            );
            $this->output->set_status_header('402');
        
            }else{
               $data = array(
                'mobile_no'    => $json_obj->mobile_no,
                );
               
                  $mobile_no=$data['mobile_no']; 
                   //$data=array('mobile_no'=>$mobile_no);
                 
               $sql="SELECT * FROM user_register WHERE mobile_no='$mobile_no'";
                 $result = $this->user_model->custom_query($sql);
                     
                     if (count($result) > 0) {
                     
           $textlocal = new Textlocal(false, false, API_KEY);

                $numbers = array($data['mobile_no']); 
                $sender = 'TXTLCL';
               
                $otp=substr(str_shuffle("0123456789"), 0,4);

                $message = "Your Verification Code is : ".$otp;
                
                try {
               
                $result1 = $textlocal->sendSms($numbers, $message, $sender);
                    if($result1){
$res = array("status" =>true, "msg" => "An otp  Is Sent To Your Mobile","otp" =>md5($otp));
 $json = array(
                    'Code'    => '200',
                    'Message' => 'send successfully',
                    'User'    =>$res,
                );
                $this->output->set_status_header('200');
           }
        else{
    
    	$json = array(
                    'Code'    => '403',
                    'Message' => 'otp not send',
                );
                $this->output->set_status_header('403');
    }        
                
                    setcookie('otp',$otp);
                    } catch (Exception $e) {
                    die('Error: ' . $e->getMessage());
                }
                
                 }
                  
                   }
                  
           
          $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
        
    }
        
        
    
   
        
        public function forgot()
          { 
      $json_obj = json_decode($this->input->raw_input_stream);
        $this->output->set_header('Access-Control-Allow-Origin: *'); 
        
             if (!property_exists($json_obj, 'email')) {
            $json = array(
                'Code'    => '402',
                'Message' => 'Email is required',
            );
            $this->output->set_status_header('402');
        
            }else{
               $data = array(
                'email'    => $json_obj->email,
                  );
               
                    $email=$data['email']; 
                
                 if($result = $this->user_model->get_or_where1('user',array('email'=>$email))){
                     
                   if (count($result) > 0) {
                     
                      $code=rand(100,999);
                      $message=" verification code $code";
                     mail($email,"Video Sharing",$message);
                     $data12 = array('activation_code'=>$code);
                     $this->user_model->entry_up($email,$data12);
                    $json = array(
                    'Code'    => '200',
                    'Message' => 'Please check your Email to reset password!',
                    'Activation_Code'=>$code,
                  );
                   }
                   }else{
                      $json = array(
                     'Code'    => '402',
                     'Message' => 'Your Email Address is not Registered.',
                     );
                  }
                 
            }
          $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
        
    }
        
        
    
    
    
     public function Resetpass()
          { 
          
          $json_obj = json_decode($this->input->raw_input_stream);
        $this->output->set_header('Access-Control-Allow-Origin: *');
          
            if (!property_exists($json_obj, 'Email')) {
            $json = array(
                'Code'    => '402',
                'Message' => 'Email is required',
            );
            $this->output->set_status_header('402');
            
            
            }else  if (!property_exists($json_obj, 'Activation_Code')) {
            $json = array(
                'Code'    => '402',
                'Message' => 'Activation Code is required',
            );
            $this->output->set_status_header('402');
    
    
          }else{
              
                $data = array(
                'Email'    => $json_obj->Email,
                'Activation_Code'   => $json_obj->Activation_Code,
                'Password'   => $json_obj->Password,
                );
               
              $activ=$data['Activation_Code'];
              $Email=$data['Email'];
                $Password=$data['Password'];
              if($resultd = $this->user_model->get_data('user',array('Email'=>$Email))){
              
                 foreach($resultd as $reds){
                     
                     $activation_code =$reds->activation_code;
                     
                     
                 }
             
                 if($activ==$activation_code){
                     
                     $data12 = array('Password'=>$Password);
                     
                     $this->user_model->entry_up($Email,$data12);
                     $json = array(
                    'Code'    => '200',
                    'Message' => 'Your Password has been changed!',
                    
                  );
                     
                     
                 }else{
                      $json = array(
                     'Code'    => '402',
                     'Message' => 'Your Password Not changed.',
                     );
                     
                     
                 }
              
         }
    
              $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    
             }
    
          }
    

    
    

    
    

    
}
