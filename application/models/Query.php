<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query extends CI_Model {

  	public function insertData($table, $data){
    	$this->db->insert($table, $data);
  	}

  	public function updateData($table, $data, $where){
    	$this->db->update($table, $data, $where);
  	}

  	public function deleteData($table, $where){
    	$this->db->delete($table, $where);
  	}

    public function select_where($table, $select, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by($order_by);
    	$this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join2($table, $table2, $join, $select, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
    	$this->db->join($table2, $join, 'inner');
        $this->db->where($where);
        $this->db->order_by($order_by);
    	$this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join3($table, $table2, $table3, $join, $select, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
    	$this->db->join($table2, $join[0], 'inner');
    	$this->db->join($table3, $join[1], 'inner');
        $this->db->where($where);
        $this->db->order_by($order_by);
    	$this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join4($table, $table2, $table3, $table4, $join, $select, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
    	$this->db->join($table2, $join[0], 'inner');
    	$this->db->join($table3, $join[1], 'inner');
    	$this->db->join($table4, $join[2], 'inner');
        $this->db->where($where);
        $this->db->order_by($order_by);
    	$this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join5($table, $table2, $table3, $table4, $table5, $join, $select, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
    	$this->db->join($table2, $join[0], 'inner');
    	$this->db->join($table3, $join[1], 'inner');
    	$this->db->join($table4, $join[2], 'inner');
    	$this->db->join($table5, $join[3], 'inner');
        $this->db->where($where);
        $this->db->order_by($order_by);
    	$this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join6($table, $table2, $table3, $table4, $table5, $table6, $join, $select, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, $join[0], 'inner');
        $this->db->join($table3, $join[1], 'inner');
        $this->db->join($table4, $join[2], 'inner');
        $this->db->join($table5, $join[3], 'inner');
        $this->db->join($table6, $join[4], 'inner');
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    #like search query
    public function select_where_join5_like($table, $table2, $table3, $table4, $table5, $join, $select, $where, $field1, $like, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, $join[0], 'inner');
        $this->db->join($table3, $join[1], 'inner');
        $this->db->join($table4, $join[2], 'inner');
        $this->db->join($table5, $join[3], 'inner');
        $this->db->where($where);
        $this->db->like($field1, $like);
        $this->db->order_by($order_by);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join4_like($table, $table2, $table3, $table4, $join, $select, $where, $field1, $like, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, $join[0], 'inner');
        $this->db->join($table3, $join[1], 'inner');
        $this->db->join($table4, $join[2], 'inner');
        $this->db->where($where);
        $this->db->like($field1, $like);
        $this->db->order_by($order_by);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    //group_by
    public function select_where_group_by($table, $select, $groupby, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->group_by($groupby);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join2_group_by($table, $table2, $join, $select, $groupby, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, $join, 'inner');
        $this->db->group_by($groupby);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join3_group_by($table, $table2, $table3, $join, $select, $groupby, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, $join[0], 'inner');
        $this->db->join($table3, $join[1], 'inner');
        $this->db->group_by($groupby);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }    

    public function select_where_join4_group_by($table, $table2, $table3, $table4, $join, $select, $groupby, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, $join[0], 'inner');
        $this->db->join($table3, $join[1], 'inner');
        $this->db->join($table4, $join[2], 'inner');
        $this->db->group_by($groupby);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join5_group_by($table, $table2, $table3, $table4, $table5, $join, $select, $groupby, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, $join[0], 'inner');
        $this->db->join($table3, $join[1], 'inner');
        $this->db->join($table4, $join[2], 'inner');
        $this->db->join($table5, $join[3], 'inner');
        $this->db->group_by($groupby);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function select_where_join6_group_by($table, $table2, $table3, $table4, $table5, $table6, $join, $select, $groupby, $where, $start, $limit, $order_by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, $join[0], 'inner');
        $this->db->join($table3, $join[1], 'inner');
        $this->db->join($table4, $join[2], 'inner');
        $this->db->join($table5, $join[3], 'inner');
        $this->db->join($table6, $join[4], 'inner');
        $this->db->group_by($groupby);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    public function truncate_kehadiran($table='')
    {
    	$this->db->truncate($table);
    	return true;
    }

    public function truncate_data_pemilih($table='')
    {
    	$this->db->truncate($table);
    	return true;
    }
}