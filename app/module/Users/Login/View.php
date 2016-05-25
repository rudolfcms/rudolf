<?php

namespace Rudolf\Modules\Users\Login;
use Rudolf\Component\Abstracts\AView,
	Rudolf\Component\Html\Text;

class View extends AView {
	
	public function form($formData, $status) {
		$this->formData = $formData;
		$this->status = $status;
		$this->template = 'login';
	}

	/**
	 * Get nick
	 * 
	 * @return string
	 */
	protected function getNick() {
		return (isset($this->formData['email'])) ? Text::escape($this->formData['email']) : '';
	}

	/**
	 * Get status info
	 * 
	 * @return array
	 */
	protected function getMessage($index = false) {
		if(!isset($this->status)) {
			return false;
		}

		switch($this->status) {
			case 1:
				$a['message'] = _('logged in');
				$a['type'] = 'success';
				break;

			case 2:
				$a['message'] = _('email not valid');
				$a['type'] = 'danger';
				break;

			case 3:
				$a['message'] = _('password not valid');
				$a['type'] = 'danger';
				break;

			case 4:
				//$a['message'] = _('user not exist');
				$a['type'] = 'danger';
				//break;

			case 5:
				$a['message'] = _('email or password incorect');
				$a['type'] = 'danger';
				break;

			case 6:
				$a['message'] = _('account is inactive');
				$a['type'] = 'danger';
				break;

			case 7:
			
			default:
				$a['message'] = _('unnamed error');
				$a['type'] = 'danger';
				break;
		}

		if(false !== $index) {
			return $a[$index];
		}

		return $a;
	}

	protected function isMessage() {
		if(!isset($this->status)) {
			return false;
		}
		return true;
	}
}
