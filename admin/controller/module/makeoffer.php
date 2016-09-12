<?php
class ControllerModuleMakeoffer extends Controller {
  private $error = array(); 

  public function index() {
    $this->load->language('module/makeoffer');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('makeoffer', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
    
    $texts = array(
      'heading_title',
      'text_module',
      'text_success',
      'text_edit',
      'text_yes',
      'text_no',
      'text_minprice',
	  'text_percent',
      'text_enabled',
      'text_disabled',
      'entry_title',
      'entry_type',
      'entry_status',
      'entry_attempts',
      'help_title',
      'help_attempts',
      'button_save',
      'button_cancel'
    );
    
    foreach($texts as $text) {
      $data[$text] = $this->language->get($text);
    }
    
    if (isset($this->error['warning'])) {
      $data['error_warning'] = $this->error['warning'];
    } else {
      $data['error_warning'] = '';
    }
     
    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
      'text'      => $this->language->get('text_home'),
      'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
    );

    $data['breadcrumbs'][] = array(
      'text'      => $this->language->get('text_module'),
      'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
    );

    $data['breadcrumbs'][] = array(
      'text'      => $this->language->get('heading_title'),
      'href'      => $this->url->link('module/makeoffer', 'token=' . $this->session->data['token'], 'SSL')
    );
    
    $data['action'] = $this->url->link('module/makeoffer', 'token=' . $this->session->data['token'], 'SSL');
    $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
    
    $datas = array(
		'makeoffer_title' => '',
		'makeoffer_type' 	=> '0',
		'makeoffer_status' => 0,
		'makeoffer_attempts' => 5
    );
    
    foreach ($datas as $key => $value) {
      if (isset($this->request->post[$key])) {
        $data[$key] = $this->request->post[$key];
      } elseif ($this->config->get($key)) {
        $data[$key] = $this->config->get($key);
      } else $data[$key] = $value;
    }
    
    $data['header'] = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('module/makeoffer.tpl', $data));
  }
  
  protected function validate() {
    if (!$this->user->hasPermission('modify', 'module/makeoffer')) {
      $this->error['warning'] = $this->language->get('error_permission');
    }
    
   return !$this->error;
  }
}
