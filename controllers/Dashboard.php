<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		set_time_limit(0);
		$this->load->database();
		$this->load->helper(array('url', 'html', 'file'));
		$this->load->library(array('form_validation', 'session'));
		$this->session;
		$this->load->model('data_model');
	}

	public function index()
	{
		$month = date('m');
		$monthname = date('F');
		$year = date('Y');
		$tpd = $this->getMonthlyTotal($month, $year);
		$monthly = $this->data_model->getTotalServicesMonthly($month, $year);
		$total = $this->data_model->getTotalServices();
		$request = $this->data_model->getTotalStatus('Requested', $month, $year);
		$plan = $this->data_model->getTotalStatus('Planned', $month, $year);
		$ongoing = $this->data_model->getTotalStatus('Ongoing', $month, $year);
		$complete = $this->data_model->getTotalStatus('Completed', $month, $year);
		$complete = $complete + $this->data_model->getTotalStatus('Rejected', $month, $year);
		$perrequest = 0;
		$perplan = 0;
		$perongoing = 0;
		$percomplete = 0;
		if($monthly > 0)
		{
			$perrequest = round(($request / $monthly) * 100);
			$perplan = round(($plan / $monthly) * 100);
			$perongoing = round(($ongoing / $monthly) * 100);
			$percomplete = round(($complete / $monthly) * 100);
		}
		$data = array(
			'perrequest' => $perrequest,
			'perplan' => $perplan,
			'perongoing' => $perongoing,
			'percomplete' => $percomplete,
			'request' => $request,
			'plan' => $plan,
			'ongoing' => $ongoing,
			'complete' => $complete,
			'unassigned' => $this->data_model->getTotalPriority('Unassigned', $month, $year),
			'low' => $this->data_model->getTotalPriority('Low', $month, $year),
			'medium' => $this->data_model->getTotalPriority('Medium', $month, $year),
			'high' => $this->data_model->getTotalPriority('High', $month, $year),
			'critical' => $this->data_model->getTotalPriority('Critical', $month, $year),
			'total' => $total,
			'monthly' => $monthly,
			'mname' => $monthname,
			'my' => $year."-".$month,
			'tpd' => $tpd
		);
		$this->load->view('vwHeader');
		$this->load->view('vwDashboard',$data);
		$this->load->view('vwFooter');
	}

	public function log()
	{
		$this->load->view('vwHeader');
		$this->load->view('vwLog');
		$this->load->view('vwFooter');
	}

	public function request()
	{
		$this->load->view('vwHeader');
		$this->load->view('vwRequest');
		$this->load->view('vwFooter');
	}

	public function process()
	{
		$this->load->view('vwHeader');
		$this->load->view('vwService');
		$this->load->view('vwFooter');
	}

	public function completed()
	{
		$this->load->view('vwHeader');
		$this->load->view('vwComplete');
		$this->load->view('vwFooter');
	}

	public function confirm($id)
	{
		$this->data_model->verifyItem($id);
		redirect(base_url('dashboard/pending'));
	}

	public function plan()
	{
		$id = $this->input->post('id');
		$priority = $this->input->post('priority');
		$target = $this->input->post('target');
		$note = $this->input->post('note');
		$data = array(
	        'service' => $id,
	        'status' => 'Plan'
		);
		$this->data_model->insertLog($data);
		$data2 = array(
	        'priority' => $priority,
	        'target' => $target,
	        'note' => $note,
	        'status' => 'Planned'
		);
		$this->data_model->updateService($id,$data2);
		redirect(base_url('dashboard/log'));
	}

	public function ongoing($servicer,$id)
	{
		$data = array(
	        'service' => $id,
	        'status' => 'Ongoing'
		);
		$this->data_model->insertLog($data);
		$data2 = array(
			'servicer' => $servicer,
	        'status' => 'Ongoing'
		);
		$this->data_model->updateService($id,$data2);
		$data3 = array(
			'available' => 'No'
		);
		$this->data_model->updateServicer($servicer,$data3);
		redirect(base_url('dashboard/log'));
	}

	public function reject($id)
	{
		$data = array(
	        'service' => $id,
	        'status' => 'Reject'
		);
		$this->data_model->insertLog($data);
		$data2 = array(
	        'status' => 'Rejected'
		);
		$this->data_model->updateService($id,$data2);
		$data3 = array(
			'available' => 'Yes'
		);
		$servicer = $this->data_model->getServicer($id);
		$this->data_model->updateServicer($servicer,$data3);
		redirect(base_url('dashboard/log'));
	}

	public function complete($id)
	{
		$data = array(
	        'service' => $id,
	        'status' => 'Complete'
		);
		$this->data_model->insertLog($data);
		$data2 = array(
	        'status' => 'Completed'
		);
		$this->data_model->updateService($id,$data2);
		$data3 = array(
			'available' => 'Yes'
		);
		$servicer = $this->data_model->getServicer($id);
		$this->data_model->updateServicer($servicer,$data3);
		redirect(base_url('dashboard/log'));
	}

	public function submit()
	{
		$data = array(
	        'item' => $this->input->post('item'),
	        'problem' => $this->input->post('problem')
		);
		$this->data_model->insertService($data);
		$id = $this->db->insert_id();
		$data2 = array(
	        'service' => $id,
	        'time' => $this->input->post('date')
		);
		$this->data_model->insertLog($data2);
		redirect(base_url('dashboard/request'));
	}

	public function dashboard($date)
	{
		$dummy = strtotime($date."-01");
		$month = date('m',$dummy);
		$monthname = date('F',$dummy);
		$year = date('Y',$dummy);
		$tpd = $this->getMonthlyTotal($month, $year);
		$monthly = $this->data_model->getTotalServicesMonthly($month, $year);
		$total = $this->data_model->getTotalServices();
		$request = $this->data_model->getTotalStatus('Requested', $month, $year);
		$plan = $this->data_model->getTotalStatus('Planned', $month, $year);
		$ongoing = $this->data_model->getTotalStatus('Ongoing', $month, $year);
		$complete = $this->data_model->getTotalStatus('Completed', $month, $year);
		$complete = $complete + $this->data_model->getTotalStatus('Rejected', $month, $year);
		$perrequest = 0;
		$perplan = 0;
		$perongoing = 0;
		$percomplete = 0;
		if($monthly > 0)
		{
			$perrequest = ($request / $monthly) * 100;
			$perplan = ($plan / $monthly) * 100;
			$perongoing = ($ongoing / $monthly) * 100;
			$percomplete = ($complete / $monthly) * 100;
		}
		$data = array(
			'perrequest' => $perrequest,
			'perplan' => $perplan,
			'perongoing' => $perongoing,
			'percomplete' => $percomplete,
			'request' => $request,
			'plan' => $plan,
			'ongoing' => $ongoing,
			'complete' => $complete,
			'unassigned' => $this->data_model->getTotalPriority('Unassigned', $month, $year),
			'low' => $this->data_model->getTotalPriority('Low', $month, $year),
			'medium' => $this->data_model->getTotalPriority('Medium', $month, $year),
			'high' => $this->data_model->getTotalPriority('High', $month, $year),
			'critical' => $this->data_model->getTotalPriority('Critical', $month, $year),
			'total' => $total,
			'monthly' => $monthly,
			'mname' => $monthname,
			'my' => $year."-".$month,
			'tpd' => $tpd
		);
		$this->load->view('vwHeader');
		$this->load->view('vwDashboard',$data);
		$this->load->view('vwFooter');
	}

	public function get_items()
	{
		$cat = $this->input->post('cat');

		$models = $this->data_model->get_items_query($cat);

		$counter = 1;
		$select_box = "";

		if(count($models) > 0)
		{
			foreach ($models as $model)
			{
				if($counter == 1)
				{
					$select_box .= "<option value='".$model->id."' title='".$model->type."' selected>".$model->id."</option>";
				}
				else
				{
					$select_box .= "<option value='".$model->id."' title='".$model->type."'>".$model->id."</option>";
				}
				$counter++;
			}
		}
		echo json_encode($select_box);
	}

	public function get_services()
	{
		$cat = $this->input->post('cat');

		$level = substr($cat, 0, 1);

		$models = $this->data_model->get_services_query($level);

		$counter = 1;
		$tr = "";
		$act = "";
		$data = array();

		if(count($models) > 0)
		{
			foreach ($models as $row)
            {
                $id = $row->id;
                $barang = $row->item;
                $level = $row->escalate;
                $petugas = $row->servicer;
                if(is_null($petugas))
                {
                	$petugas = '-';
                }
                $masalah = $row->problem;
                $prioritas = $row->priority;
                if($prioritas == 'Unassigned')
                {
                	$prioritas = '-';
                }
                $status = $row->status;
                $inisial = $row->initial;
                $date = $row->target;
                if(is_null($date))
                {
                	$target = '-';
                }
                else
                {
                	$target = $row->target;
                }

                $tr .= "<tr><td class='text-center'>".$id;
                $tr .= "</td><td class='text-center'>".$barang;
                $tr .= "</td><td class='text-center'>".$level;
                $tr .= "</td><td class='text-center'>".$petugas;
                $tr .= "</td><td class='text-center'>".$masalah;
                $tr .= "</td><td class='text-center'>".$prioritas;
                $tr .= "</td><td class='text-center'>".$inisial;
                $tr .= "</td><td class='text-center'>".$target;
                $tr .= "</td><td class='text-center'>".$status;
                $tr .= "</td><td class='text-center'>";
                
                if($status == "Requested")
                { 
                	$act .= "<button class='btn btn-success act-button' role='button' data-toggle='modal' data-target='#modal-plan' title='Plan' id='".$id."' onclick='setID(this.id)'><i class='fa fa-pencil' aria-hidden='true'></i></button>";
                }
                elseif($status == "Planned")
                { 
                	$act .= "<button class='btn btn-success act-button' role='button' data-toggle='modal' data-target='#' title='Ongoing' id='".$id."' onclick='ongoing(this.id)'><i class='fa fa-cog' aria-hidden='true'></i></button>";
                }
                elseif($status == "Ongoing")
                { 
                	$act .= "<button class='btn btn-success act-button' role='button' data-toggle='modal' data-target='#' title='Complete' id='".$id."' onclick='complete(this.id)'><i class='fa fa-check' aria-hidden='true'></i></button>";
                }

                $act .=  "<span style='margin-left:4px;margin-right:4px;'></span>";
                $act .=  "<button class='btn btn-info act-button' role='button' data-toggle='modal' data-target='#escalate-modal' title='Eskalasi' id='".$id."' onclick='setID(this.id)'><i class='fa fa-level-up' aria-hidden='true'></i></button>";
                $act .=  "<span style='margin-left:4px;margin-right:4px;'></span>";
                $act .= "<button class='btn btn-danger act-button' role='button' data-toggle='tooltip' title='Reject' id='".$id."' onclick='reject(this.id)'><i class='fa fa-times' aria-hidden='true'></i></button>";

                $tr .= $act;
                $tr .= "</td></tr>";

                $data[] = array($id, $barang, $level, $petugas, $masalah, $prioritas, $inisial, $target, $status, $act);
                $act = "";
            }
		} 

		$output = array(
			'recordsTotal' => $this->data_model->get_services_filtered($level),
			'recordsFiltered' => $this->data_model->get_services_total(),
			'data' => $data
		);

		delete_files('assets/json/');
		write_file('assets/json/services.json', json_encode($output));

		echo json_encode($output);
	}

	public function getMonthlyTotal($month, $year)
	{
		$number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$data = array();
		$col = array();
		$row = array();

		$col[] = array(
			'label' => 'Tanggal', 
			'type' => 'number'
		);
		$col[] = array(
			'label' => 'Unassigned', 
			'type' => 'number'
		);
		$col[] = array(
			'label' => 'Low', 
			'type' => 'number'
		);
		$col[] = array(
			'label' => 'Medium', 
			'type' => 'number'
		);
		$col[] = array(
			'label' => 'High', 
			'type' => 'number'
		);
		$col[] = array(
			'label' => 'Critical', 
			'type' => 'number'
		);

		for($d=1; $d <= $number; $d++)
		{
			$c = array();
			$day = sprintf('%02d', $d);
			$date = $year."-".$month."-".$day;
			$unassigned = $this->data_model->getTPD('Unassigned',$date);
			$low = $this->data_model->getTPD('Low',$date);
			$medium = $this->data_model->getTPD('Medium',$date);
			$high = $this->data_model->getTPD('High',$date);
			$critical = $this->data_model->getTPD('Critical',$date);
			$c[] = array('v' => $d);
			$c[] = array('v' => $unassigned);
			$c[] = array('v' => $low);
			$c[] = array('v' => $medium);
			$c[] = array('v' => $high);
			$c[] = array('v' => $critical);
			
			$row[] = array(
				'c' => $c
			);
		}

		$data = array(
			'cols' => $col,
			'rows' => $row
		);

		return json_encode($data);
	}
}
