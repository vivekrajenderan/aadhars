<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* CodeIgniter Account Model
 *
* @package          CodeIgniter
 * @author          Kumaresan T
 * @company         Innoppl Technologies
 * @link            http://www.innoppl.com
 * @version         1.0
 */


class Webservice_model extends CI_Model
{

    function __construct()
    {
        parent::__construct(); 
    }

    public function view_requirement()
    {
        $baseurl=base_url()."assets/job_icon/";
        $list_group=array();
       // $select="R.name,CONCAT(".$baseurl."upload/CSR/,`R`.`file_name`) as original_image,CONCAT(".$baseurl."upload/CSR/,`R`.`tab_image`) as tab_image,ER.*";
        //$this->db->select('R.name,CONCAT("'.$baseurl.'",R.file_name) as original_image,ER.*');
        $this->db->select('R.name, CONCAT("'.$baseurl.'", '.', R.file_name) AS original_image,CONCAT("'.$baseurl.'", '.', R.tab_image) AS tab_image,CONCAT("'.$baseurl.'", '.', R.mobile_image) AS mobile_image,ER.*', FALSE);

        $this->db->from('requirement_type R',false);
        $this->db->join('employee_requirement as ER','ER.type_id=R.id'); 
        $this->db->where("ER.status",1);                                          
        $query = $this->db->get();                    
        if($query->num_rows>0){
            $list_group=$query->result_array();            
            return $list_group;
        }else{
            return $list_group;
        }
    }

    function csr_activities_list()
     {
        
     $baseurl=base_url();     
     $query='Select name,CONCAT("'.$baseurl.'upload/CSR/",file_name) as original_image,CONCAT("'.$baseurl.'upload/CSR/",mobile_image) as mobileImage, CONCAT("'.$baseurl.'upload/CSR/",tab_image) as tabImage from csr_activities';
     $query = $this->db->query($query);
        if($query->num_rows() > 0){
            $list_tags = $query->result_array();            
            return $list_tags;
        }else{
            return array();
        }
     }


     public function add_refer_friend($set_data)
    {
       $this->db->insert('refer_friend',$set_data);
       return $this->db->insert_id();
    }
    public function add_referFriend_details($set_data)
    {
       $this->db->insert('refer_friend_details',$set_data);
       
    }

    public function get_user_id($user)
    {
        $row=array();
        $this->db->select('id');
        $this->db->from('user'); 
        $this->db->where('employee_id', $user);
        //$this->db->where('employee_id', 'INO '.$user);
        $this->db->where('status', '1');
        $query = $this->db->get();
        $row=$query->result_array();
        return $row;
        
    }

    public function add_job_apply($set_data)
    {
       $this->db->insert('job_apply',$set_data);
       return $this->db->insert_id();
    }

    public function add_job_skill($set_data)
    {
       $this->db->insert('job_skill',$set_data);
       return $this->db->insert_id();
    }

    public function add_job_work_experience($set_data)
    {
       $this->db->insert('job_work_experience',$set_data);
       return $this->db->insert_id();
    }

    public function add_job_academic_detail($set_data)
    {
       $this->db->insert('job_academic_detail',$set_data);
       return $this->db->insert_id();
    }
}
