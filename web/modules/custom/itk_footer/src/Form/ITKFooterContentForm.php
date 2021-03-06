<?php
/**
 * @file
 * Contains Drupal\itk_footer\Form\ITKFooterContentForm.
 */

namespace Drupal\itk_footer\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ITKFooterContentForm
 *
 * @package Drupal\itk_footer\Form
 */
class ITKFooterContentForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'itk_footer_settings';
  }

  /**
   * Get key/value storage for base config.
   *
   * @return object
   */
  private function getBaseConfig() {
    return \Drupal::getContainer()->get('itk_footer.config');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->getBaseConfig();

    $form['wrapper'] = array(
      '#title' => t('ITK Footer'),
      '#type' => 'details',
      '#description' => t('Configure the content of the footer module.'),
      '#weight' => '1',
      '#open' => TRUE,
    );

    $form['wrapper']['itk_footer_title'] = array(
      '#title' => t('Title'),
      '#type' => 'textfield',
      '#default_value' => $config->get('itk_footer_title'),
      '#weight' => '1',
    );

    $form['wrapper']['itk_footer_text'] = array(
      '#title' => t('Text'),
      '#type' => 'text_format',
      '#format' => 'filtered_html',
      '#default_value' => $config->get('itk_footer_text'),
      '#weight' => '2',
    );

    $form['actions'] = array('#type' => 'actions');
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#attributes' => ['class' => ['button--primary']],
      '#value' => t('Save content'),
      '#weight' => '6',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message('Settings saved');

    // Set the rest of the configuration values.
    $this->getBaseConfig()->setMultiple(array(
      'itk_footer_title' => $form_state->getValue('itk_footer_title'),
      'itk_footer_text' => $form_state->getValue('itk_footer_text')['value'],
    ));

    drupal_flush_all_caches();
  }
}

