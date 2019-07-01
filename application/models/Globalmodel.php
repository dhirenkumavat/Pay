<?php

Class Globalmodel extends CI_Model {

    public function add($table, $data) {
        $data2=array();
        foreach($data as $key=>$val){
            $data2[$key]=$this->db->escape_str($val);
        }
        $this->db
                 ->insert($table, $data2);
        return $this->db->insert_id();
    }
    
      public function query($query) {
      $q=  $this->db->query($query);
        return  $q->row_array();
    }
    
     public function query2($query) {
      $q=  $this->db->query($query);
        return  $q->result_array();
    }

    public function delete($table, $where) {
        return $this->db
                        ->delete($table, $where);
    }

    public function update($table, $where, $data) {
        $data2=array();
        foreach($data as $key=>$val){
            $data2[$key]=$this->db->escape_str($val);
        }
        $data3=array();
        foreach($where as $key=>$val){
            $data3[$key]=$this->db->escape_str($val);
        }
        return $this->db
                        ->where($data3)
                        ->update($table, $data2);
    }

	public function select_unique($table, $where = array()) {
        $q = $this->db
                ->select('*')
               
                ->where($where)
                
                ->get($table);
        return $q->result_array();
    }

    public function select_all($table, $where = array()) {
        $data2=array();
        foreach($where as $key=>$val){
            $data2[$key]=$this->db->escape_str($val);
        }
        $q = $this->db
                ->where($data2)
                
                ->get($table);
        return $q->result_array();
    }
    
    public function select_limit($table, $where = array(),$limit = false, $offset = false) {
        $data2=array();
        foreach($where as $key=>$val){
            $data2[$key]=$this->db->escape_str($val);
        }
        $q = $this->db
                ->where($data2)
                ->limit($limit, $offset)
                ->get($table);
        return $q->result_array();
    }
    
    
    public function select_all_sort($table, $where = array(),$like = array(), $limit = False, $offset = False,$order_field,$order) {
        $q = $this->db
                ->where($where)
                ->like($like)
                ->limit($limit, $offset)
                ->order_by($order_field,$order)
                ->get($table);
        return $q->result_array();
    }
    
    public function select_recent($table, $where = array(), $order_field) {
        $q = $this->db
                ->where($where)
                ->limit(1)
                ->order_by($order_field,'desc')
                ->get($table);
        return $q->row_array();
    }
    public function select_data($limit, $start,$where) {
        $this->db->limit($limit, $start);
        $this->db->where($where);
        $q = $this->db->get("coupons");
        
        return $q->result_array();
    }
    public function search($table, $where = array(), $like = array(), $or_where = array(), $or_like = array(), $limit = False, $offset = False) {
        $q = $this->db
                ->where($where)
                ->or_where($or_where)
                ->like($like)
                ->or_like($or_like)
                ->limit($limit, $offset)
                ->get($table);
         return $q->result_array();
         
    }
    
    public function search2($table, $where = array(), $like = array(), $or_where = array(), $or_like = array(), $limit = False, $offset = False) {
        $q = $this->db
                ->where_in($where)
                ->or_where($or_where)
                ->like($like)
                ->or_like($or_like)
                ->limit($limit, $offset)
                ->get($table);
         return $q->result_array();
         
    }

    public function select_single($table, $where) {
        $data2=array();
        foreach($where as $key=>$val){
            $data2[$key]=$this->db->escape_str($val);
        }
        $q = $this->db
                ->where($data2)
                ->get($table);
        return $q->row_array();
    }
       public function select_limited($table, $where = array(), $limit) {
        $q = $this->db
                ->where($where)
                ->limit($limit)
                ->get($table);
        return $q->result_array();
    }
    public function count_rows($table, $where = array(),$like=array()) {
        $q = $this->db
                ->where($where)
                ->like($like)
                ->get($table);
        return $q->num_rows();
    }

    public function join_2table($table1,$table2,$join_str,$where=array(),$like=array()) {
        $q=$this->db
                ->where($where)
                ->like($like)
                ->from($table1)
                ->join($table2, $join_str)
                ->get();
        return  $q->result_array();
    }

}
