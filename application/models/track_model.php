<?php
class Track_model extends CI_Model {

	public function __construct()
	{
	}
	
	function go_track($data)
	{
		$this->db->insert('job_track', $data); 
	}
	
	function del_track($t_id)
	{
		$this->db->delete('job_track', array('t_id' => $t_id)); 
		return 0;
	}	
	function select_track($s_id)
	{
		$query = $this->db->get_where('job_track',array('s_id'=>$s_id));
//		return $query->result();
		return $query->result_array();
/*
		$num=0;
		foreach ($query->result_array() as $row)
		{	
			$result[$num]=array(
				"j_name" => $row['j_name'],
				"j_url" => $row['j_url'],
				"j_cname" => $row['j_cname'],
				"j_address" => $row['j_address'],
				"j_date" => $row['j_date']
				);
			$num++;
		}
		$result1=json_encode($result);
		//print_r($result);
		
		
		echo $result1;
*/
	}
}

?>
