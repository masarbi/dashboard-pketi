<?php
	class Data_model extends CI_Model
	{
		//Fi, I love you more than anything yet I hate you. Funny how you said your love is not my love when what you do is unfaithful to me. Did you know my love to you? What I do just for you just for this 2 years? When I sacrifice everything just for you and you said to let you love another and I must stay silent and watch you loving others.
		function __construct()
		{
			parent::__construct();
		}

		function insertService($data)
	    {
	        $this->db->insert('service', $data);
	    }

		function insertLog($data)
	    {
	        $this->db->insert('service_log', $data);
	    }

	    function updateService($id,$data)
	    {
	        $this->db->where('id', $id);
	        $this->db->update('service', $data);
	    }

	    function updateServicer($id,$data)
	    {
	        $this->db->where('id', $id);
	        $this->db->update('servicer', $data);
	    }

	    function getServicer($id)
		{
			$sql = "SELECT servicer FROM service WHERE id = '".$id."'";

			$query = $this->db->query($sql);
			$servicer = "";

			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					$servicer = $row->servicer;
				}
				return $servicer;
			}
			else
			{
				return "-";
			}
		}

		function getTotalStatus($status, $month, $year)
		{
			$sql = "SELECT a.id FROM service a JOIN service_log b ON a.id = b.service WHERE MONTH(b.time) = '".$month."' AND YEAR(b.time) = '".$year."' AND b.status = 'Request' AND a.status = '".$status."' GROUP BY b.service ORDER BY b.time DESC";

			$query = $this->db->query($sql);

			return $query->num_rows();
		}

		function getTotalPriority($priority, $month, $year)
		{
			$sql = "SELECT a.id FROM service a JOIN service_log b ON a.id = b.service WHERE MONTH(b.time) = '".$month."' AND YEAR(b.time) = '".$year."' AND b.status = 'Request' AND a.priority = '".$priority."' GROUP BY b.service ORDER BY b.time DESC";

			$query = $this->db->query($sql);

			return $query->num_rows();
		}
		function getTPD($priority,$date)
		{
			$sql = "SELECT a.id FROM service a JOIN service_log b ON a.id = b.service WHERE a.priority = '".$priority."' AND DATE(b.time) = '".$date."' AND b.status = 'Request' GROUP BY b.service ORDER BY b.time DESC";

			$query = $this->db->query($sql);

			return $query->num_rows();
		}

		function getTotalServicesMonthly($month, $year)
		{
			$sql = "SELECT a.id FROM service a JOIN service_log b ON a.id = b.service WHERE MONTH(b.time) = '".$month."' AND YEAR(b.time) = '".$year."' AND b.status = 'Request' GROUP BY b.service ORDER BY b.time DESC";

			$query = $this->db->query($sql);

			return $query->num_rows();
		}

		function getTotalServices()
		{
			$sql = "SELECT * FROM service";

			$query = $this->db->query($sql);

			return $query->num_rows();
		}

		function get_items_query($cat)
		{
			$sql = "SELECT * FROM item WHERE branch = '".$cat."'";

			$query = $this->db->query($sql);

			return $query->result();
		}

		function get_services_total()
		{
			$sql = "SELECT a.id, a.item, a.escalate, a.servicer, a.problem, a.priority, DATE(b.time) AS initial, a.target, a.status FROM service a JOIN service_log b ON a.id = b.service WHERE b.status = 'Request' AND a.status <> 'Completed' ORDER BY initial DESC, id DESC";

			$query = $this->db->query($sql);

			return $query->num_rows();
		}

		function get_services_filtered($cat)
		{
			$sql = "SELECT a.id, a.item, a.escalate, a.servicer, a.problem, a.priority, DATE(b.time) AS initial, a.target, a.status FROM service a JOIN service_log b ON a.id = b.service WHERE b.status = 'Request' AND a.status <> 'Completed' AND a.escalate = '".$cat."' ORDER BY initial DESC, id DESC";

			$query = $this->db->query($sql);

			return $query->num_rows();
		}

		function get_services_query($cat)
		{
			$sql = "SELECT a.id, a.item, a.escalate, a.servicer, a.problem, a.priority, DATE(b.time) AS initial, a.target, a.status FROM service a JOIN service_log b ON a.id = b.service WHERE b.status = 'Request' AND a.status <> 'Completed' AND a.escalate = '".$cat."' ORDER BY initial DESC, id DESC";

			$query = $this->db->query($sql);

			return $query->result();
		}
	}
?>