<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function insert($data)
    {
        return $this->db->insert('user_register', $data);
    }
    
     public function getuseByTestId($id)
    {
      $query = $this->db->select('*')->from('users')->where('id', $id)->get();
        return $query->result_array();
    }
      
      public function get_one_row($tbl_name, $cond)

    {

        $query = $this->db->get_where($tbl_name, $cond);

        return $query->row();

    }
     public function getAll()
    {
        $query = $this->db->get('users');
       
        return $query->result_array();
    }
    
    
      public function getById($id)
    {
        $query = $this->db->select('*')->from('users')->where('id', $id)->get();
        return $query->result_array();
    }
    
   function is_email_available($email)  
      {  
           $this->db->where('email', $email);  
           $query = $this->db->get("user_register");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      } 
      
      
     function update_device($cond,$data){
$this->db->where($cond);

$this->db->update('users',$data);
}
      
     function updated($cond,$data){
$this->db->where($cond);

$this->db->update('Fcm_token',$data);
}  
      
      function updat($cond1,$data){
$this->db->where($cond1);

$this->db->update('Fcm_token',$data);
}   
      
    public function entry_update1($id,$data12) {

            $this->db->set($data12);
            $this->db->where('id',$id);
            $update = $this->db->update('users');
            if($update)
            {
                return true;
            }
            else
            {
               return false;
            }

         }
         
         
         
          public function entry_up($email,$data12) {

            $this->db->set($data12);
            $this->db->where('email',$email);
            $update = $this->db->update('user_register');
            if($update)
            {
                return true;
            }
            else
            {
               return false;
            }

         }
      
      public function get_or_where1($tbl_name, $cond)

      {

        $this->db->where($cond);

      

        $query = $this->db->get($tbl_name);

        return $query->result();

    }
    
     public function get_data($tbl_name, $cond)

    {

        $query = $this->db->get_where($tbl_name,$cond);

        return $query->result();
}


 public function insert2($data1)
    {
        return $this->db->insert('Fcm_token', $data1);
    }
    
    public function update_tbl($tbl_name, $cond, $data)

    {

        $this->db->where($cond);

        $this->db->update($tbl_name,$data);

    }
    
     public function get_or_where($tbl_name, $cond, $or_cond)

    {

        $this->db->where($cond);

        $this->db->or_where($or_cond);

        $query = $this->db->get($tbl_name);

        return $query->result();

    }
    function custom_query($data)

        {

            $query = $this->db->query($data);

            return $query->result();
          }
    
    function is_mob_available($mobile_no)  
      {  
           $this->db->where('mobile_no', $mobile_no);  
           $query = $this->db->get("user_register");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      } 
}
