<?php
class Common extends CI_Controller {




 function districts()
 {
  if($this->input->post('state_id'))
  {
   echo $this->common_model->fetch_district($this->input->post('state_id'));
  }
 }

 function mandals()
 {
  if($this->input->post('district_id'))
  {
   echo $this->common_model->fetch_mandal($this->input->post('district_id'));
  }
 }
 function gramapanchayats()
 {
  if($this->input->post('mandal_id'))
  {
   echo $this->common_model->fetch_gramapanchayat($this->input->post('mandal_id'));
  }
 } 
 function subcategory()
 {
  if($this->input->post('category_id'))
  {
   echo $this->common_model->fetch_subcategory($this->input->post('category_id'));
  }
 }
 
 
 
 
}