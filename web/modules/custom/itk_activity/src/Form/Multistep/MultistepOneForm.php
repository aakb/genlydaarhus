<?php

/**
 * @file
 * Contains \Drupal\itk_activity\Form\Multistep\MultistepOneForm.
 */

namespace Drupal\itk_activity\Form\Multistep;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class MultistepOneForm.
 *
 * @package Drupal\itk_activity\Form\Multistep
 */
class MultistepOneForm extends MultistepFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'multistep_form_one';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    $form['title'] = array(
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => $this->t('Title'),
      '#default_value' => $this->store->get('title') ? $this->store->get('title') : '',
    );

    $form['body'] = array(
      '#type' => 'textarea',
      '#required' => TRUE,
      '#title' => $this->t('Description'),
      '#default_value' => $this->store->get('description') ? $this->store->get('description') : '',
    );

    $form['signup_required'] = array(
      '#type' => 'radios',
      '#required' => TRUE,
      '#title' => $this->t('Sign up required'),
      '#default_value' => 1,
      '#options' => [
        1 => $this->t('Sign up required'),
        0 => $this->t('Sign up not required'),
      ],
    );

    $form['actions']['submit']['#value'] = $this->t('Next');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Set values in storage.
    $this->store->set('title', $form_state->getValue('title'));
    $this->store->set('body', $form_state->getValue('body'));

    // Redirect to next step.
    $form_state->setRedirect('itk_activity.multistep_two');
  }

}
