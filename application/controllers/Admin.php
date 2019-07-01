<?php
error_reporting(0);
/****************************************
Project for: Metch
Design & Developed By: Natrajinfotech.in
Start Date: 08,Feb,2018
Company Name: Natrajinfotech.in, Indore(M.P.)

****************************************/
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
  

  //constructer of controller
  public function __construct()
  {
      parent:: __construct();
	      $this->load->helper(array('url','cookie', 'form','file'));
      $this->load->library(array('form_validation', 'session','upload','image_lib','pagination', 'email'));
$this->load->model('globalmodel');
    $this->load->model('Common');
    $this->load->model('admin_model');

  $data = array();
            $data['result']=array();
            $userid = $this->session->userdata('userid');
            $tab_name = "admin";
            $tab_sel = "id,username";
            $tab_where =" id='$userid'";
            $order_colname ="id";
            $order_by ="desc";
           
            $result = $this->Common->get_all_entries($tab_name,$tab_sel,$tab_where,$order_colname,$order_by);
            $data['result'] = $result;
  }
  
  public function flashdata($id,$msg){
      $this->session->set_flashdata($id,$msg);
  }

// Get data for Admin index
  public function index(){
     $data['message_status'] = 0; 
     $userid = $this->session->userdata('userid');
     if(isset($_POST['submit'])){
        $username = $_POST["username"];
        $password = $_POST["password"]; 
        $tab_name = "admin";
       $tab_sel = "id,username";
     $tab_where = "username ='".$username."' AND password ='". $password ."'AND Status = 1";
        // Get data for users tables
      $result = $this->Common->select_single_row($tab_name, $tab_sel, $tab_where);
      
     if (count($result) > 0) {
    $sessionData = array(
             'userid' => $result[0]['id'],
             'username' => $result[0]['username'],
           );
             $userid = $result[0]['id'];
             print_r($id);

              $this->session->set_userdata($sessionData);
              redirect('admin/dashboard');
         }else{
            // if count result is less than 0
            $data['error'] = "Invalid Username or Password";
            $this->session->set_userdata($data);
            redirect('admin/index');
                }
            }
          $this->load->view('index',$data);
  }
// Get data for Admin Dashboard

    public function dashboard() {
 
$this->load->view('dashboard');
       
    }
	
	// user list
public function user_list() {



 if (isset($_POST['submit'])) 
      {
   $browser1 = $this->input->post('browser1');
  $browser2 = $this->input->post('browser2');
  $browser3 = $this->input->post('browser3');

 $data['browser'] = $this->admin_model->search($browser1,$browser2,$browser3);
//print_r($datbrowser);
	  }
   $data['countryi'] = $this->admin_model->get_all_data('country');
    $data['users_all'] = $this->admin_model->get_all_data('user_register');

    $this->load->view('user_list',$data);
      }
	
//DELETE User LIST
    public function delete_user($id)
   {
  
  $array = array('id' => $id);
  $this->admin_model->delete_data('user_register', $array);
  redirect('admin/user_list');
 }

//search moonid and get detail
 public function search_moonid() {
 $data = array();  
	if (isset($_POST['submit'])) 
      {
 $moon_id = $this->input->post('moon_id');
$data['moonid'] =  $this->admin_model->searchd($moon_id);
	  }
$this->load->view('search_moonid',$data);
       
    }

    
    public function Add_Currency() {
    $data="";
      if (isset($_POST['currency_submit']))
    {
        $currency_type = $this->input->post('currency_type');
      $data = array(
      'currency_type' => $currency_type
    );
    $this->admin_model->curdata($data);
   $data['success'] = "Currency Added Successfully.";
    }
     $this->load->view('admin/Add_Currency',$data);
     }


  //DELETE Currency
    public function delete_Currency($id)
   {
  
  $array = array('id' => $id);
  $this->admin_model->delete_data('currency', $array);
  redirect('admin/Currency');
 }

public function edit_Currency($id)
   {
  
  
  $cond = array('id'=>$id);
  $result = $this->admin_model->get_one_row('currency', $cond);
  $data['currency'] = $result;
  if (isset($_POST['submit']))
  {
  $currency_type= $this->input->post('currency_type');
   if ($currency_type !=$result->currency_type) 
   {
    $array['currency_type'] = $currency_type;
   }
    
   
   $cond = array('id'=>$id);
  $this->admin_model->update_tbl('currency',$cond,$array);
   $data['success'] = " Updated Successfully.";
   redirect('admin/Currency');
   }
  $this->load->view('admin/edit_Currency',$data);
  }
  
  


public function Atm_list() {
     
     
     $data['Atm_all'] = $this->admin_model->get_all_data('atm_details');
      
   $this->load->view('admin/Atm_list',$data);
       
    }
    
    //DELETE ATM LIST
    public function delete_ATM($id)
   {
  
  $array = array('id' => $id);
  $this->admin_model->delete_data('atm_details', $array);
  redirect('admin/Atm_list');
 }

//edit atm list

public function edit_ATM($id)
   {
       $data="";
  $data['currency_all'] = $this->admin_model->get_all_data('currency');
  
  $cond = array('id'=>$id);
  $result = $this->admin_model->get_one_row('atm_details', $cond);
  $data['atm_detail'] = $result;
  if (isset($_POST['submit']))
  {
  $City = $this->input->post('City');
   if ($City !=$result->City) 
   {
    $array['City'] = $City;
   }
    $Village = $this->input->post('Village');
   if ($Village !=$result->Village) 
   {
    $array['Village'] = $Village;
   }
   $Pincode	 = $this->input->post('Pincode');
   if ($Pincode	 !=$result->Pincode	) 
   {
    $array['Pincode'] = $Pincode;
   }
   $ATM_Name= $this->input->post('ATM_Name');
   if ($ATM_Name !=$result->ATM_Name) 
   {
    $array['ATM_Name'] = $ATM_Name;
   }
  
   $config['upload_path'] = 'assets/images/';
              $config['allowed_types'] = 'jpg|png';
              $config['max_size'] = 5024;
           

             $this->load->library('upload', $config);
  
   if ($_FILES['Image']['name']!="") 
	{
 if (!$this->upload->do_upload('Image')) {
    $error = array('error' => $this->upload->display_errors());
  } else {
    $fileData = $this->upload->data();
    $array['Image'] = $fileData['file_name'];
  }
 
} 
    
    $Currency= $this->input->post('Currency');
    
     $Currency1= implode(", ",$Currency);
     
   if ($Currency1 !=$result->Currency) 
   {
    $array['Currency'] = $Currency1;
   }
   
   $cond = array('id'=>$id);
  $this->admin_model->update_tbl('atm_details',$cond,$array);
   $data['success'] = " Updated Successfully.";
   redirect('admin/Atm_list');
   }
  $this->load->view('admin/edit_ATM',$data);
  }
  
  

public function Atm() {
    
    $data="";
     $data['currency_all'] = $this->admin_model->get_all_data('currency');
      if (isset($_POST['atm_submit']))
    {
        
    $Currency1 = implode(",", $this->input->post('Currency'));
    if(!empty($_FILES['Image']['name'])){
                $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx';
                $config['max_size']      = 1024;
                $config['file_name'] = $_FILES['Image']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('Image')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
            }else{
                $picture = '';
            }

        $City = $this->input->post('City');
          $Village = $this->input->post('Village');  
          $Pincode = $this->input->post('Pincode'); 
          $ATM_Name = $this->input->post('ATM_Name');
            $Location = $this->input->post('Location');  
           $Latitude = $this->input->post('Latitude');
            $Longitude = $this->input->post('Longitude'); 
            $Image = $this->input->post('Image'); 

              $Currency = $Currency1;
      $data = array(
      'City' => $City,
      'Village' => $Village,
      'Location' => $Location,
      'Pincode' => $Pincode,
      'ATM_Name' => $ATM_Name,
      'Longitude' => $Longitude,
       'Latitude' => $Latitude,
      'Currency' => $Currency,
'Image' => $picture



    );
    $this->admin_model->atm_data($data);
   $data['success'] = "Detail Added Successfully.";
    }
     $this->load->view('admin/Atm',$data);
     }


 

    
    public function Add_Village() {
         
    $data="";
    $data['city_all'] = $this->admin_model->get_all_data('city');
      if (isset($_POST['pro_submit']))
    {
        $Village_Name = $this->input->post('Village_Name');
         $City_id = $this->input->post('City_id');
      $data = array(
      'Village_Name' => $Village_Name,
      'City_id' => $City_id
    );
    $this->admin_model->invillage($data);
   $data['success'] = "Village Added Successfully.";
    }
     $this->load->view('admin/Add_Village',$data);
     }
    
    
    public function logout(){
	$this->session->unset_userdata('userid');
	$this->session->sess_destroy();
         redirect('index');
}



    // public function videos() {
     
    // $data['videos'] = $this->globalmodel->select_all('videos',array());
   // $this->load->view('videos',$data);
       // }
    
	// Add Video
    public function add_video() {

  $data['outletdata'] = $this->admin_model->get_all_data('outlets');

    $this->load->view('upload_video',$data);
       }
	
	
	// Video LIST
	public function video_list() {
   $id=$this->uri->segment('3');
   		      $sql8= "select videos.*,outlets.name from videos INNER JOIN outlets on outlets.id=videos.outletname";
$data['videos'] = $this->admin_model->custom_query($sql8);


 //$data['videos'] = $this->admin_model->get_all_data('videos');
    $this->load->view('video_list',$data);
      }

    
    public function upload_video(){
        date_default_timezone_set("Asia/Kolkata");
                $date = date("Y-m-d H:i:s");

				
     $config['upload_path']   = './uploads/videos/'; 
         $config['allowed_types'] = '*'; 
         $config['file_name']=time().rand(111111,999999);
         
        
         $this->load->library('upload');
			$this->upload->initialize($config);
         if ( ! $this->upload->do_upload('myfile')) {
            echo 'Video File Error! Please try again.';
         }
			
         else { 
           $uploadData = $this->upload->data();
            $data['video_file'] = $uploadData['file_name'];
         } 
                
          $data['remark']=$this->input->post('remark');
       $data['outletname']=$this->input->post('chkveg');
          $data['brand_id']=$this->input->post('brand_id');
         $data['created_date']=$date;
         $data['status']='1';
  $add= $this->admin_model->insert_data('videos',$data);
 // $check = $this->input->post('chkveg');

          // $check=$this->input->post('chkveg');

// for ($i=0; $i < count($check); $i++) { 

        // $data = array('id'=>null,
        // 'vid' => $add[$i],
        // 'outletname' => $check[$i]
                // );
				//print_r($data);
    // } 
    
	 
        // $result = $this->admin_model->AddPurchaseOrder($data);

         if($add){

            echo 'Video Added Successfully.'; 
         }else{
            echo 'Please try again.'; 
         }
    }
    
    
	// modify video (edit)
	 public function modify_video($id)
              {
  
        $cond = array('id'=>$id);
        $result = $this->admin_model->get_one_row('videos', $cond);
     $data['videoes'] = $result;
	 
         if (isset($_POST['update']))
      {
		  $config['upload_path']   = './uploads/videos/'; 
         $config['allowed_types'] = '*'; 
         $config['file_name']=time().rand(111111,999999);
         
        
         $this->load->library('upload');
			$this->upload->initialize($config);
         if ( ! $this->upload->do_upload('myfile')) {
            echo 'Video File Error! Please try again.';
         }
			
         else { 
           $uploadData = $this->upload->data();
            $data['video_file'] = $uploadData['file_name'];
			
         }
	 $remark = $this->input->post('remark');
     $chkveg = $this->input->post('chkveg');
     $video_fil = $this->input->post('myfile');
     
      $array = array(
		  'remark'=> $remark,
		  'outletname'=> $chkveg,
		  'video_file'=> $video_fil,
		   );
		  
     $cond = array('id'=>$id);
   $this->admin_model->update_tbl('videos',$cond,$array);
    $this->flashdata('success','Update Successfully.'); 
     //redirect('house_list');

	  }
	    $data['outletdata'] = $this->admin_model->get_all_data('outlets');

  $this->load->view('modify_video',$data);
  }
	
      
function delete_video($id,$path)
    {
             $del_path= unlink(FCPATH.'uploads/videos/'.$path);
if($del_path==1){
    $query = $this->db->query("DELETE FROM videos WHERE id = '$id'");
            $this->flashdata('success','Delete Record Successfully.'); 
    redirect('admin/video_list');

  }
     }
     
    
    public function categories(){
        $data['cats'] = $this->globalmodel->select_all('categories');
    $this->load->view('categories',$data);
    }
    
    public function add_category() {
    $this->load->view('add_category');
       
    }
    
    public function upload_category(){
        
         $post=$this->input->post();
         $add=$this->globalmodel->add('categories',$post);
         if($add){
            $this->flashdata('success','Category Added Successfully.'); 
            return redirect('admin/add_category');
         }else{
            $this->flashdata('fail', 'Please try again.'); 
            return redirect('admin/add_category');
         }
    }
    
    public function outlets(){
        $data['outlets'] = $this->globalmodel->select_all('outlets');
    $this->load->view('outlets',$data);
    }
    
    public function add_outlet() {
		if (isset($_POST['submit']))
    {
    date_default_timezone_set("Asia/Kolkata");
                $date = date("Y-m-d H:i:s");
       $array = array(
      'name' => $this->input->post('name'),
      'address' => $this->input->post('address'),
      'location' => $this->input->post('location'),
      'country' => $this->input->post('country'),
      'state' => $this->input->post('state'),
      'city' => $this->input->post('city'),
      'latitude' => $this->input->post('latitude'),
      'longitude' => $this->input->post('longitude'),
      'pincode' => $this->input->post('pincode'),
      'brandid' => $this->input->post('brandid'),
      'created_date' => $date,
    'status' => '1'
      );
 $this->admin_model->insert_data('outlets', $array);
    }
	   $data['countryi'] = $this->admin_model->get_all_data('country');

    $this->load->view('add_outlet',$data);
       
    }

	// delete Outlet
	 public function delete_outlet($id)
       {
        $array = array('id' => $id);
        $this->admin_model->delete_data('outlets', $array);
        redirect('outlet_list' ,$data);
       }  
	   
	   // view Outlet detail
	public function view_outlet_detail($id)
              {
  
        $cond = array('id'=>$id);
        $result = $this->admin_model->get_one_row('outlets', $cond);
     $data['outletss'] = $result;

   $this->load->view('view_outlet_detail',$data);

			  }
			  
			  public function edit_outlets($id)
              {
  
        $cond = array('id'=>$id);
        $result = $this->admin_model->get_one_row('outlets', $cond);
     $data['outletss'] = $result;
         if (isset($_POST['update']))
      {
		  
	 $name = $this->input->post('name');
     $address = $this->input->post('address');
     $country = $this->input->post('country');
     $state = $this->input->post('state');
     $city = $this->input->post('city');
     $location = $this->input->post('location');
     $latitude = $this->input->post('latitude');
     $longitude = $this->input->post('longitude');
     $pincode = $this->input->post('pincode');
	 
      $array = array(
		  'name'=> $name,
		  'address'=> $address,
		  'country'=> $country,
		  'state'=> $state,
		  'city'=> $city,
		  'location'=> $location,
		  'latitude'=> $latitude,
		  'longitude'=> $longitude,
		  'pincode'=> $pincode,
		   );
		  
     $cond = array('id'=>$id);
   $this->admin_model->update_tbl('outlets',$cond,$array);
    $this->flashdata('success','Update Successfully.'); 
     //redirect('house_list');

	  }
	  	  	   $data['countryi'] = $this->admin_model->get_all_data('country');

  $this->load->view('edit_outlets',$data);
  }
	

	   
    public function upload_outlet(){
        
         $post=$this->input->post();
         $add=$this->globalmodel->add('outlets',$post);
         if($add){
            $this->flashdata('success','Oulet Added Successfully.'); 
            return redirect('admin/add_outlet');
         }else{
            $this->flashdata('fail', 'Please try again.'); 
            return redirect('admin/add_outlet');
         }
    }
    
    public function brand_list() {
  
   $data['brands'] = $this->globalmodel->select_all('brands');
    $this->load->view('brands',$data);
      }
      
      public function add_brand() {
		  if (isset($_POST['submit'])) 
 {
     date_default_timezone_set("Asia/Kolkata");
                $date = date("Y-m-d H:i:s");
                

$data['brand_name'] = $this->input->post('brand_name');
$data['mcoin'] = $this->input->post('mcoin');
$data['brand_msg'] = $this->input->post('brand_msg');
$data['brand_info'] = $this->input->post('brand_info');
$data['download_msg'] = $this->input->post('download_msg');
$data['download_link'] = $this->input->post('download_link');
$data['countryname'] = $this->input->post('countryname');
$data['statename'] =$this->input->post('statename');
$data['cityname'] =$this->input->post('cityname');
$data['privacy_policy'] = $this->input->post('privacy_policy');
$data['brand_tc'] = $this->input->post('brand_tc');
$data['playstore_url'] = $this->input->post('playstore_url');
$data['hashtag'] = $this->input->post('hashtag');
$data['ques_type'] = $this->input->post('ques_type');
$data['option1'] = $this->input->post('option1');
$data['option2'] = $this->input->post('option2');
$data['option3'] = $this->input->post('option3');
$data['option4'] = $this->input->post('option4');
$data['question'] = $this->input->post('question');

  $config2['upload_path']   = './uploads/images/'; 
         $config2['allowed_types'] = '*'; 
         $config2['file_name']=time().rand(111111,999999);
         
          
         $this->load->library('upload');
		
         	$this->upload->initialize($config2);
         if ( ! $this->upload->do_upload('brand_logo')) {
            $this->flashdata('fail',  'Brand Logo File Error! Please try again.');
         }
			
         else { 
           $uploadData = $this->upload->data();
            $data['brand_logo'] = $uploadData['file_name'];
         } 
         
         
         	$this->upload->initialize($config2);
         if ( ! $this->upload->do_upload('thumb_url')) {
            $this->flashdata('fail',  'Thumb Image File Error! Please try again.');
         }
			
         else { 
           $uploadData = $this->upload->data();
            $data['thumb_url'] = $uploadData['file_name'];
         } 
         
   $data['status']='1';
   $this->admin_model->insert_data('brands',$data);
    $this->flashdata('success','Brand Added Successfully.'); 
   }
	   $data['countryi'] = $this->admin_model->get_all_data('country');

    $this->load->view('add_brand',$data);
       }
	   
	   //Active Brand LIST
	   public function active_brand_list(){
		 $data['activebrand'] = $this->admin_model->get_activebrand_data('brands');

		  $this->load->view('active_brand_list',$data);
        }
		
		// delete active brand list
			 public function delete_activebrand($id)
       {
        $this->checkAuth();
        $array = array('id' => $id);
        $this->admin_model->delete_data('brands', $array);
        redirect('active_brand_list' ,$data);
       }   
	   
	   //Inactivate brand (active list)
 public function inactivate_brand($id)
    {
        $cond = array('id'=>$id);
        $data = array('status'=>0);
        $this->admin_model->update_tbl('brands', $cond, $data); 
        redirect('inactive_brand_list');
    }

       //InActive Brand LIST
	   public function inactive_brand_list(){
		 $data['inactivebrand'] = $this->admin_model->get_inactivebrand_data('brands');

		  $this->load->view('inactive_brand_list',$data);
        }
		
		//Activate Brand(inactivate list)
    public function activatebrand($id)
    {
        $cond = array('id'=>$id);
        $data = array('status'=>1);
        $this->admin_model->update_tbl('brands', $cond, $data); 
        redirect('active_brand_list');
    }
	
	// Edit Brand detail(modify)
	
	public function edit_brand($id)
              {
  
        $cond = array('id'=>$id);
        $result = $this->admin_model->get_one_row('brands', $cond);
     $data['brandss'] = $result;
         if (isset($_POST['update']))
      {
		  
	 $brand_name = $this->input->post('brand_name');
     $mcoin = $this->input->post('mcoin');
     $brand_msg = $this->input->post('brand_msg');
     $brand_info = $this->input->post('brand_info');
     $download_msg = $this->input->post('download_msg');
     $download_link = $this->input->post('download_link');
     $countryname = $this->input->post('countryname');
     $statename = $this->input->post('statename');
     $cityname = $this->input->post('cityname');
     $privacy_policy = $this->input->post('privacy_policy');
     $brand_tc = $this->input->post('brand_tc');
     $playstore_url = $this->input->post('playstore_url');
     $hashtag = $this->input->post('hashtag');
     $ques_type = $this->input->post('ques_type');
     $option1 = $this->input->post('option1');
     $option2 = $this->input->post('option2');
     $option3 = $this->input->post('option3');
     $option4 = $this->input->post('option4');
     $question = $this->input->post('question');
     $brand_logo = $this->input->post('brand_logo');
     $thumb_url = $this->input->post('thumb_url');
    
    $config2['upload_path']   = './uploads/images/'; 
         $config2['allowed_types'] = '*'; 
         $config2['file_name']=time().rand(111111,999999);
         
          
         $this->load->library('upload');
		
         	$this->upload->initialize($config2);
         if ( ! $this->upload->do_upload('brand_logo')) {
            $this->flashdata('fail',  'Brand Logo File Error! Please try again.');
         }
			
         else { 
           $uploadData = $this->upload->data();
            $brand_logo = $uploadData['file_name'];
         } 
         
         
         	$this->upload->initialize($config2);
         if ( ! $this->upload->do_upload('thumb_url')) {
            $this->flashdata('fail',  'Thumb Image File Error! Please try again.');
         }
			
         else { 
           $uploadData = $this->upload->data();
            $thumb_url = $uploadData['file_name'];
         } 
  
		  $array = array(
		  'brand_name'=> $brand_name,
		  'mcoin'=> $mcoin,
		  'brand_msg'=> $brand_msg,
		  'brand_info'=> $brand_info,
		  'download_msg'=> $download_msg,
		  'download_link'=> $download_link,
		  'countryname'=> $countryname,
		  'statename'=> $statename,
		  'cityname'=> $cityname,
		  'privacy_policy'=> $privacy_policy,
		  'brand_tc'=> $brand_tc,
		  'playstore_url'=> $playstore_url,
		  'hashtag'=> $hashtag,
		  'ques_type'=> $ques_type,
		  'option1'=> $option1,
		  'option2'=> $option2,
		  'option3'=> $option3,
		  'option4'=> $option4,
		  'question'=> $question,
		  'brand_logo'=> $brand_logo,
		  'thumb_url'=> $thumb_url,
		   );
		  
     
    $cond = array('id'=>$id);
   $this->admin_model->update_tbl('brands',$cond,$array);
    $this->flashdata('success','Brand Update Successfully.'); 
     //redirect('house_list');

	  }
	  	   $data['countryi'] = $this->admin_model->get_all_data('country');

  $this->load->view('edit_brand',$data);
  }
	

// view brand detail
	public function view_brand_detail($id)
              {

        $cond = array('id'=>$id);
		      $sql2= "select brands.*,country.country_name,state.state_name ,city.city_name from brands INNER JOIN country on country.id=brands.countryname LEFT JOIN state on state.id=brands.statename LEFT JOIN city on city.id=brands.cityname
			  where brands.id='$id'";
$data['brandsss'] = $this->admin_model->custom_query($sql2);

        // $result = $this->admin_model->get_one_row('brands', $cond);
     // $data['brandsss'] = $result;

   $this->load->view('view_brand_detail',$data);

			  }
			  
			   // ajax select state on country click add brand page
	 	public function select_state1()
         {
        $country = $_POST['country'];

       $countryss = $this->admin_model->get_data('state', array('countryid'=>$country));
        foreach ($countryss as $countrys){
       echo "<option value='".$countrys['id']."'>$countrys[state_name]</option>";
      }
	  }
	  
	  //(add_outlet map running but database enter city column in city name)
	  
	  // ajax select city on state click add brand page
	 	public function select_city2()
         {
          $state1 = $_POST['state'];
       $statess1 = $this->admin_model->get_data('city', array('stateid'=>$state1));
	   
        foreach ($statess1 as $states){
       echo "<option value='".$states['city_name']."'>$states[city_name]</option>";
      }
	  }


	  // ajax select city on state click add brand page
	 	public function select_city1()
         {
          $state = $_POST['state'];
       $statess = $this->admin_model->get_data('city', array('stateid'=>$state));
	   
        foreach ($statess as $states){
       echo "<option value='".$states['id']."'>$states[city_name]</option>";
      }
	  }

	
	// Outlet List
		   public function outlet_list(){
			      $id=$this->uri->segment('3');
// $sql3= "select outlets.*,country.country_name,state.state_name ,city.city_name from outlets INNER JOIN country on country.id=outlets.country LEFT JOIN state on state.id=outlets.state LEFT JOIN city on city.id=outlets.city
			  // ";
// $data['outletdata'] = $this->admin_model->custom_query($sql3);

		 $data['outletdata'] = $this->admin_model->get_all_data('outlets');

		  $this->load->view('outlet_list',$data);
        }

		//add country
	 public function add_country() {

	if (isset($_POST['submit']))
    {
date_default_timezone_set("Asia/Kolkata");
                $date = date("Y-m-d H:i:s");
       $array = array(
      'country_name' => $this->input->post('country_name'),
      'created_date' => $date,
    'status' => '1'
      );
 $this->admin_model->insert_data('country', $array);
    }

   $this->load->view('add_country');

    }
	
	// Country List
		public function country_list() {
	
   $data['countryi'] = $this->admin_model->get_all_data('country');
    $this->load->view('country_list',$data);
      }

	  // Delete Country List
	  
	      public function delete_country($id)
   {
  
  $array = array('id' => $id);
  $this->admin_model->delete_data('country', $array);
  redirect('admin/country_list');
 }

	
	//add state
	 public function add_state() {
	if (isset($_POST['submit']))
    {
       date_default_timezone_set("Asia/Kolkata");
                $date = date("Y-m-d H:i:s");
       $array = array(
      'state_name' => $this->input->post('state_name'),
      'countryid' => $this->input->post('countryid'),
       'created_date' => $date,
    'status' => '1'
     );
	
   $this->admin_model->insert_data('state', $array);
	}
	   $data['countryi'] = $this->admin_model->get_all_data('country');

	   $this->load->view('add_state',$data);
     }
	 
	 // State List
		public function state_list() {
	
   $data['states'] = $this->admin_model->get_state_list('state');
    $this->load->view('state_list',$data);
      }

	 
	  //add city
    public function add_city() {
	if (isset($_POST['submit']))
    {
date_default_timezone_set("Asia/Kolkata");
                $date = date("Y-m-d H:i:s");
       $array = array(
      'city_name' => $this->input->post('city_name'),
      'country_id' => $this->input->post('countryid'),
       'stateid' => $this->input->post('state_name'),
       'created_date' => $date,
        'status' => '1'
 );
	
   $this->admin_model->insert_data('city', $array);

   }
    $data['countryi'] = $this->admin_model->get_all_data('country');
   $sql1= "sELECT `city`.`city_name` ,`city`.id, `city`.created_date,`state`.`state_name` ,`country`.country_name FROM `city` INNER JOIN `state` ON `state`.`id`= `city`.`stateid` INNER JOIN `country` ON `country`.`id`= `city`.`country_id`
";
$data['city'] = $this->admin_model->custom_query($sql1);

   $this->load->view('add_city',$data);

    }
	
	// City List
		public function city_list() {
	
   $data['citiess'] = $this->admin_model->get_city_list('city');
    $this->load->view('city_list',$data);
      }

	  // Delete City List
	 public function delete_city($id)
   {
  $array = array('id' => $id);
  $this->admin_model->delete_data('city', $array);
  redirect('admin/city_list');
 }
	
  // ajax select state on country click
	 	public function select_state()
         {
        $countryid = $_POST['countryid'];

       $citys = $this->admin_model->get_data('state', array('countryid'=>$countryid));
        foreach ($citys as $cityss){
       echo "<option value='".$cityss['id']."'>$cityss[state_name]</option>";
      }
	  }


    
	public function view_googlemap() {
	
	 $check1=$this->uri->segment('3');
	$data['countryi'] = $this->admin_model->get_all_data('country');
		      $sql5= "select user_register.*, city.city_name from user_register INNER JOIN city on city.id = user_register.city where user_register.city='$check1'";
$data['userss'] = $this->admin_model->custom_query($sql5);
    $this->load->view('view_googlemap',$data);
      }

 	// notification code user list
	
	public function notification()
    {
		

 $data['users_all'] = $this->admin_model->get_all_data('user_register');
  if(isset($_POST['submit'])){
       $user_id = $this->input->post('user_id');
	   $id=implode(",",$user_id);
     $users_all = $this->admin_model->getuserdata($id);
 foreach($users_all as $rowdata){
   $device_token=$rowdata->device_token;
     $id=$rowdata->id;
   


$send_message=$this->input->post('msg');

define('API_ACCESS_KEY', 'AIzaSyBd2IQhnEfsR0pdWr62w3C7XF2aI04CQ90');
$data = array("to" =>$device_token,
              "notification" => array( "title" => 'notify', "body" => $send_message,"icon" => "ic_notification","sound" => "default"));  

$data_string = json_encode($data); 
$headers = array
(
     'Authorization: key=' . API_ACCESS_KEY, 
     'Content-Type: application/json'
);
$ch = curl_init();  
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
curl_setopt( $ch,CURLOPT_POST, true );  
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
$result = curl_exec($ch);

curl_close ($ch);
//print_r($result);
}

}
$this->load->view('notification',$data);

	}



}


