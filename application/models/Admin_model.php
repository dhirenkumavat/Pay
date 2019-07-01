<?php

class Admin_model extends CI_Model {



 function __construct()

    {

        // Call the Model constructor

        parent::__construct();

        $this->load->database();

        $this->load->library('email');



    }
    
    
    public function get_all_data($tbl_name)

    {

        $query = $this->db->get($tbl_name);

        return $query->result();

    }

    public function get_data($tbl_name, $cond)

    {

        $query = $this->db->get_where($tbl_name, $cond);

        return $query->result_array();

    }

    public function get_like_data($tbl_name, $cond, $like_key)

    {

        $this->db->where($cond);

        $this->db->like($like_key);

        $query = $this->db->get($tbl_name);

        return $query->result();

    }
  
  
    public function get_or_where($tbl_name, $cond, $or_cond)

    {

        //print_r($cond);

        //print_r($or_cond);die();

        $this->db->where($cond);

        $this->db->or_where($or_cond);

        $query = $this->db->get($tbl_name);

        //print_r($query->result()); die();

        return $query->result();

    }

    public function get_limited_data($tbl_name, $cond, $limit, $start)

    {

        $this->db->where($cond);

        $this->db->limit($limit, $start);

        $query = $this->db->get($tbl_name);

        return $query->result();

    }

    public function get_limited_data_like_where($tbl_name, $cond, $like_key, $limit, $start)

    {

        //print_r($like_key);die();

        $this->db->where($cond);

        $this->db->like($like_key);

        $this->db->limit($limit, $start);

        $query = $this->db->get($tbl_name);

        return $query->result();

    }

    public function get_data_with_order_and_limit($tbl_name, $cond, $field, $method, $limit, $start)

    {

        $this->db->where($cond);

        $this->db->limit($limit, $start);

        $this->db->order_by("$field", "$method");

        $query = $this->db->get($tbl_name);

        return $query->result();

    }
    public function get_data_with_order($tbl_name, $cond, $field, $method)

    {

        $this->db->where($cond);

        $this->db->order_by("$field", "$method");

        $query = $this->db->get($tbl_name);

        return $query->result();

    }

    public function get_one_row($tbl_name, $cond)

    {

        $query = $this->db->get_where($tbl_name, $cond);

        return $query->row();

    }

    public function delete_data($tbl_name, $cond)

    {

        $this->db->delete($tbl_name, $cond);

    }

    public function update_tbl($tbl_name, $cond,$data)

    {

        $this->db->where($cond);

        $this->db->update($tbl_name,$data);

    }

    public function send_mail($to, $subject, $body, $from)

    {

        $headers='';

        $headers .= "Reply-To:".$from."\r\n"; 

        $headers .= "Return-Path:".$from."\r\n"; 

        $headers .= "From:Harmony System<".$from.">\r\n";

        $headers .= "Organization: Sender Organization\r\n";

        $headers .= "MIME-Version: 1.0\r\n";

        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        $headers .= "X-Priority: 3\r\n";

        $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

        return mail($to, $subject, $body, $headers);

    }

    public function insert_data($tbl_name,$data)

    {

        $this->db->insert($tbl_name, $data);

        $insert_id = $this->db->insert_id();



        return  $insert_id;

    }

    public function select_max_id($tbl_name, $field)

    {

        $this->db->select_max("$field");

        $query = $this->db->get($tbl_name);

        

        return $result = $query->row();

    }
    
public function atm_data($data)
    {
        return $this->db->insert('atm_details', $data);
    }

 public function inse($data)
    {
        return $this->db->insert('city', $data);
    }
    
    public function curdata($data)
    {
        return $this->db->insert('currency', $data);
    }

 public function invillage($data)
    {
        return $this->db->insert('village', $data);
    }

    public function select_min_id($tbl_name, $field)

    {

        $this->db->select_min("$field");

        $query = $this->db->get($tbl_name);

        

        return $result = $query->row();

    }

    public function get_data_using_join_two($main_tbl, $sec_tbl, $select_from_first, $select_from_second ,$join_on)

    {

       $this->db->select("$select_from_first, $select_from_second");

       $this->db->from("$main_tbl");

       $this->db->join("$sec_tbl", "$sec_tbl.$join_on = $main_tbl.$join_on", "LEFT");

       $query = $this->db->get();

       return $query->result();

    }

    function insert_entries($table_name,$table_data)
  {
    $this->db->insert($table_name,$table_data);

    return $this->db->insert_id();
    
  }
  
  
  
    public function get_data_using_join_two_with_where($main_tbl, $sec_tbl, $select_from_first, $cond , $select_from_second ,$join_on, $limit)

    {

       $this->db->select("$select_from_first, $select_from_second");

       $this->db->from("$main_tbl");

       $this->db->join("$sec_tbl", "$sec_tbl.$join_on = $main_tbl.$join_on", "LEFT");

       $this->db->where($cond);

       $query = $this->db->get();

       if ($limit == 'row') 
       {

           return $query->row();

       }

       if($limit == 'data')

       {

            return $query->result();

        }

    }

function custom_query_select($query)
    {
        $query = $this->db->query($query);
        //print_r($this->db->last_query());exit();
        $data = array();
if($query !== FALSE && $query->num_rows() > 0){
    foreach ($query->result_array() as $row) {
        $data[] = $row;
    }
}

return $data;
    }




function getvillage(){
  $this->db->select("village.id,village.City_id,village.Village_Name,city.City_name");
  $this->db->from('village');
  $this->db->join('city','city.id = village.City_id');
  $query = $this->db->get();
  return $query->result();
 }


 function getsubcategory(){
  $this->db->select("tbl_subcategories.id,tbl_subcategories.cate_id,tbl_subcategories.SubCategoryName,tbl_subcategories.Status,tbl_subcategories.Create_Date,tbl_categories.CategoryName");
  $this->db->from('tbl_subcategories');
  $this->db->join('tbl_categories','tbl_categories.id = tbl_subcategories.cate_id');
  $query = $this->db->get();
  return $query->result();
 }
 function getsecondsubcategory(){
  $this->db->select("tbl_subsubcategory.id,tbl_subsubcategory.cate_id,tbl_subsubcategory.subcate_id,tbl_subsubcategory.subsubcategoryname,tbl_subsubcategory.Status,tbl_subsubcategory.Create_Date,tbl_subcategories.SubCategoryName,tbl_categories.CategoryName");
  $this->db->from('tbl_subsubcategory');
   $this->db->join('tbl_categories','tbl_categories.id = tbl_subsubcategory.cate_id');
  $this->db->join('tbl_subcategories','tbl_subcategories.id = tbl_subsubcategory.subcate_id');
  $query = $this->db->get();
  return $query->result();
 }
 
 function getthirdsubcategory(){
  $this->db->select("tbl_thirdsubcategory.id,tbl_thirdsubcategory.cate_id,tbl_thirdsubcategory.subcate_id,tbl_thirdsubcategory.secandsub_id ,tbl_thirdsubcategory.thirdsubcategoryname,tbl_thirdsubcategory.Status,tbl_thirdsubcategory.Create_Date,tbl_subcategories.SubCategoryName,tbl_categories.CategoryName,tbl_subsubcategory.subsubcategoryname");
  $this->db->from('tbl_thirdsubcategory');
   $this->db->join('tbl_categories','tbl_categories.id = tbl_thirdsubcategory.cate_id');
  $this->db->join('tbl_subcategories','tbl_subcategories.id = tbl_thirdsubcategory.subcate_id');
  $this->db->join('tbl_subsubcategory','tbl_subsubcategory.id = tbl_thirdsubcategory.secandsub_id');
  $query = $this->db->get();
  return $query->result();
 }

 function getmedicines(){
  $this->db->select("master_medicines.id,master_medicines.medicinesCategoryid,master_medicines.MedicinesName,master_medicines.Status,master_medicines.Create_Date,master_medicinescategory.medicinesCategoryName");
  $this->db->from('master_medicines');
  $this->db->join('master_medicinescategory','master_medicinescategory.id = master_medicines.medicinesCategoryid');
  $query = $this->db->get();
  return $query->result();
 }
 
 function getaccessories(){
  
  $this->db->select("tbl_accessories.id,tbl_accessories.product_id,tbl_accessories.accessories_name,tbl_accessories.image,tbl_accessories.Status,tbl_accessories.Create_Date,tbl_product.Titile");
  $this->db->from('tbl_accessories');
  $this->db->join('tbl_product','tbl_product.id = tbl_accessories.product_id');
 
  $query = $this->db->get();
 return $query->result();
  
   }
    function getusers(){
  $this->db->select("tbl_users.id,tbl_users.name,tbl_users.gst,tbl_users.email,tbl_users.company_name,tbl_users.company_type,tbl_users.address,tbl_users.mobile,
  tbl_users.State_id,tbl_users.City_Name,tbl_users.company_website,
  tbl_users.remark,tbl_users.status,tbl_users.Create_date,tbl_state.State,tbl_city.City_Name");
  $this->db->from('tbl_users');
  $this->db->join('tbl_state','tbl_state.id = tbl_users.State_id');
  $this->db->join('tbl_city','tbl_city.id = tbl_users.City_Name');
  $query = $this->db->get();
  return $query->result();
 }
 
function getproducts(){
$this->db->select("tbl_product.id,tbl_product.Titile,tbl_product.Sub_title,tbl_product.Price,tbl_product.Cate_id,tbl_product.Subcate_id,tbl_product.Secsubcate_id,tbl_product.thirdsubcate_id,tbl_product.Image,tbl_product.pro_image1,tbl_product.pro_image2 ,tbl_product.pro_image3,tbl_product.pro_image4,tbl_product.Product_Details,tbl_product.Specifications,tbl_product.Status,tbl_product.Create_Date");
  $this->db->from('tbl_product');
  
     
  $query = $this->db->get();

 
  return $query->result();
}


 
// moon id detail search
 public function searchd($moon_id)
{
	           $q = $this->db->query("select user_register.*, country.country_name,state.state_name,city.city_name from user_register inner join country on country.id=user_register.country left join state on state.id=user_register.state left join city on city.id=user_register.city
where user_register.moon_id LIKE '$moon_id'");
             return $q->result();

}

// active brand list
public function get_activebrand_data(){
           $q = $this->db->query("select brands.*,country.country_name,state.state_name ,city.city_name from brands INNER JOIN country on country.id=brands.countryname LEFT JOIN state on state.id=brands.statename LEFT JOIN city on city.id=brands.cityname where brands.status='1'");
             return $q->result_array();
    }

// inactive brand list
public function get_inactivebrand_data(){
           $q = $this->db->query("select brands.*,country.country_name,state.state_name ,city.city_name from brands INNER JOIN country on country.id=brands.countryname LEFT JOIN state on state.id=brands.statename LEFT JOIN city on city.id=brands.cityname where brands.status='0'");
             return $q->result_array();
    }
	
	// new function
         function custom_query($data)

        {

            $query = $this->db->query($data);

            return $query->result();
			}
			
			//function multiple array insert
    public function AddPurchaseOrder($data){

$this->db->insert_batch('video_outlet', $data); 
}

 public function get_data3($state)
      {
	$query = $this->db->query("select city.*, state.state_name ,state.id from city inner join state on state.id = city.stateid where city.stateid = '".$state."'

");
        return $query->result_array();
     }
	 
	     
	 // search country state city filter
	 
	  public function search($browser1,$browser2,$browser3)
{
    $this->db->select('*');
    $this->db->from('user_register');
    $this->db->like('city',$browser3);
    // $this->db->or_like('state',$browser2);
    // $this->db->or_like('city',$browser3);
    
    $query = $this->db->get();
//print_r($query);
    return $query->result();
}
	 
	 // state list
	public function get_state_list()
      {
	$query = $this->db->query("select state.*, country.country_name  from state inner join country on country.id = state.countryid");
        return $query->result();
     }
 

public function getuserdata($id)
      {
  $query = $this->db->query("SELECT `id`,`device_token` FROM `user_register` WHERE `id` IN($id)");
        return $query->result();
     }




// City list
	public function get_city_list()
      {
	$query = $this->db->query("select city.*, country.country_name,state.state_name from city inner join country on country.id = city.country_id Left join state on state.id = city.stateid");
        return $query->result();
     }
	 
	 // notification user list model
	 
	 	  // public function notification($check)
// {

// $q = $this->db->query("select * from user_register where id IN ($check)");
            // return $q->result();
// }

function notification($id)
 {
	$query = $this->db->query("select * from user_register where id='$id'");
        return $query->result();

 }

	
}
?>