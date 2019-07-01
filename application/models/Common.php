<?php

class Common extends CI_Model {



 function __construct()

    {

        // Call the Model constructor

        parent::__construct();

        $this->load->database();



    }

    public function get_all_data($tbl_name)

    {

        $query = $this->db->get($tbl_name);

        return $query->result();

    }
    

    public function get_data($tbl_name, $cond)

    {

        $query = $this->db->get_where($tbl_name,$cond);

        return $query->result();

    }

    public function get_or_where($tbl_name, $cond, $or_cond)

    {

        $this->db->where($cond);

        $this->db->or_where($or_cond);

        $query = $this->db->get($tbl_name);

        return $query->result();

    }

public function get_or_where1($tbl_name, $cond)

    {

        $this->db->where($cond);

      

        $query = $this->db->get($tbl_name);

        return $query->result();

    }
    public function get_one_row($tbl_name, $cond)

    {

        $query = $this->db->get_where($tbl_name, $cond);

        return $query->row();

    }
    
     public function get_one_row1($tbl_name, $cond)

    {

        $query = $this->db->get_where($tbl_name, $cond);

        return $query->result_array();

    }

    public function delete_data($tbl_name, $cond)

    {

        $this->db->delete($tbl_name, $cond);

    }

    public function update_tbl($tbl_name, $cond, $data)

    {

        $this->db->where($cond);

        $this->db->update($tbl_name,$data);

    }

    public function insert_data($tbl_name, $data)

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

    public function select_min_id($tbl_name, $field)

    {

        $this->db->select_min("$field");

        $query = $this->db->get($tbl_name);

        return $result = $query->row();

    }
     
     function select_single_row($tab_name,$tab_sel,$tab_where)
    {
        $this->db->select($tab_sel);
        if($tab_where!=""){
        $this->db->where($tab_where);
        }
        $query=$this->db->get($tab_name);
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return array();   
        }
    }
     
     
    public function get_data_with_order($tbl_name, $cond, $field, $method)

    {

        $this->db->where($cond);

        $this->db->order_by("$field", "$method");

        $query = $this->db->get($tbl_name);

        return $query->result();

    }
    public function get_latest_tweets($token, $token_secret, $consumer_key, $consumer_secret, $host, $method, $path, $query)
    {
       $oauth = array(
            'oauth_consumer_key' => $consumer_key,
            'oauth_token' => $token,
            'oauth_nonce' => (string)mt_rand(), 
            'oauth_timestamp' => time(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_version' => '1.0'
        );

        $oauth = array_map("rawurlencode", $oauth); 
        $query = array_map("rawurlencode", $query);

        $arr = array_merge($oauth, $query); 

        asort($arr); 
        ksort($arr); 

        
        $querystring = urldecode(http_build_query($arr, '', '&'));

        $url = "https://$host$path";

        
        $base_string = $method."&".rawurlencode($url)."&".rawurlencode($querystring);

        
        $key = rawurlencode($consumer_secret)."&".rawurlencode($token_secret);

        
        $signature = rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));

        
        $url .= "?".http_build_query($query);
        $url=str_replace("&amp;","&",$url); 

        $oauth['oauth_signature'] = $signature; 
        ksort($oauth); 

        function add_quotes($str) { return '"'.$str.'"'; }
        $oauth = array_map("add_quotes", $oauth);

        $auth = "OAuth " . urldecode(http_build_query($oauth, '', ', '));

        
        $options = array( CURLOPT_HTTPHEADER => array("Authorization: $auth"),
                          //CURLOPT_POSTFIELDS => $postfields,
                          CURLOPT_HEADER => false,
                          CURLOPT_URL => $url,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_SSL_VERIFYPEER => false);

        
        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);

        return json_decode($json);
    }


   public function get_all_solution_data($tbl_name)

    {

        $query = $this->db->get($tbl_name);

        return $query->result();

    }

//function get_submenu(){
 //$categories = $this->db->get('tbl_categories');
 //  foreach ($categories->result() as $categoris){
 //   $id=$categoris->id;
 //   $subcate = $this->db->get_where('tbl_subcategories',
  //  array('cate_id'=>$id));

  // $categoris->subcate = $subcate->result();
  //  }
   // return $categories->result();
   //  }

public function get_categories()
{
    $query = $this->db->get('tbl_categories');
    $return = array();

    foreach ($query->result() as $category)
    {
        $return[$category->id] = $category;
        $return[$category->id]->subs = $this->get_sub_categories($category->id); // Get the categories sub categories
        
    }

    return $return;
}


public function get_sub_categories($category_id)
{
    $this->db->where('cate_id', $category_id);
    $query = $this->db->get('tbl_subcategories');
    return $query->result();
}


    function insert_entries($table_name,$table_data)
    {
        $this->db->insert($table_name,$table_data);
        
        return $this->db->insert_id();
        
    }
    function get_all_entries($tab_name,$tab_sel,$tab_where,$order_colname,$order_by)
    {
        $this->db->select($tab_sel);
        if(!empty($tab_where))
        {
            $this->db->where($tab_where);
        }
        if(!empty($order_colname) && !empty($order_by)){
            $this->db->order_by($order_colname, $order_by);
        }
        $query=$this->db->get($tab_name);
        //echo $this->db->last_query();
        return $query->result_array();  
    
        // select * from registration limit 0,10
    }

  



function get_submenu(){
 $categories = $this->db->get('tbl_categories');
   foreach ($categories->result() as $categoris){
     $id=$categoris->id;
   $subcate = $this->db->get_where('tbl_subcategories',
  array('cate_id'=>$id));
  $categoris->subcate = $subcate->result();
 
}
   return $categories->result();
    }


function getproducts($id=""){
$this->db->select("tbl_newproduct.pro_id,tbl_newproduct.Status,tbl_newproduct.Create_Date,tbl_product.Titile,tbl_product.Sub_title,tbl_product.Image");
  $this->db->from('tbl_newproduct');
   $this->db->join('tbl_product','tbl_product.id = tbl_newproduct.pro_id');
   $this->db->where('tbl_newproduct.pro_id',$id);

  $query = $this->db->get();
  
 
 
  return $query->result();
}

public function get_all_images($pro_id = FALSE){
       

$this->db->select("tbl_newproduct.id,tbl_newproduct.pro_id,tbl_product.Image");
  $this->db->from('tbl_newproduct');
  $this->db->join('tbl_product','tbl_product.id = tbl_newproduct.pro_id');
$query = $this->db->get();
  return $query->result();
}



}
    ?>