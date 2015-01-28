<?php

namespace Base\Controller;

use Zend\Session\Container;

trait Common
{
	protected function getModel($model) {
		return $this->getServiceLocator()->get($model);
	}
	
	protected function getDoctrineEntityManager() {
		return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	}
	
	protected function getViewHelper($helperName)
	{
		return $this->getServiceLocator()->get('viewhelpermanager')->get($helperName);
	}
	
	protected function getHeadScript()
	{
		return $this->getViewHelper('HeadScript');
	}
	
	protected function getHeadLink()
	{
		return $this->getViewHelper('HeadLink');
	}
	
	protected function addPageMessage($message, $messageType = '')
	{
		$session = new Container(__NAMESPACE__.'\Page\Messages');
		
		$pageMessages = array();
		
		if ( $session->offsetExists('pageMessages') ) {
			$pageMessages = $session->offsetGet('pageMessages');
		}
			
		$pageMessages[] = array(
			'message' => $message,
			'type' => $messageType
		);
		
		$session->offsetSet('pageMessages', $pageMessages);
	}
	
	protected function getPageMessages()
	{
		$session = new Container(__NAMESPACE__.'\Page\Messages');
		
		$pageMessages = array();
		
		if ( $session->offsetExists('pageMessages') ) {
			$pageMessages = $session->offsetGet('pageMessages');
		}
		
		$session->offsetUnset('pageMessages');
		
		return $pageMessages;
	}
}

