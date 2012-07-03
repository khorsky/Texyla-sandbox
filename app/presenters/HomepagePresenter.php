<?php

use Nette\Application\UI\Form;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

	/**
	 * Example form factory
	 * @return Form
	 */
	protected function createComponentExampleForm()
	{
		$form = new Form;

		$form->addTextarea("text", NULL, 80, 20)
			->getControlPrototype()->class("texyla");

		$form->addSubmit("s", "Submit");
		$form->onSuccess[] = callback($this, 'exampleFormSubmitted');
		return $form;
	}

	/**
	 * Get submited data from the form
	 */
	public function exampleFormSubmitted($form)
	{
		// Get values from the form
		$values = $form->getValues();

		// Get TEXY service to apply it at raw data
		$texy = $this->context->Texy;

		// Process data through TEXY
		$html = $texy->process($values->text);

		// Here should be action you would like to do with data - save to the DB, etc.
		// Flash message
		$this->flashMessage('Data were sucessfuly procesed');

		// Call redirect
		$this->redirect('Homepage:default');
	}
	
}
