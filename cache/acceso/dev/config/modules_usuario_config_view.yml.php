<?php
// auto-generated by sfViewConfigHandler
// date: 2016/05/19 00:00:30
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('default.css', '', array ());
  $response->addStylesheet('global.css', '', array ());
  $response->addStylesheet('theme/jquery-ui.css', '', array ());
  $response->addJavascript('jqueryTooltip.js', '', array ());
  $response->addJavascript('imgpreview.0.23.js', '', array ());


